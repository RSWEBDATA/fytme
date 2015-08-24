<?php
error_reporting(E_ALL);

    $errors = array();

    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    $chooseState = getAllState($dbconn);
    $allTrClasses = getAllTrClasses($dbconn, $contactId);
    $allTrLocate = getAllTrLocations($dbconn, $contactId);
    $contact = getSingleContact($dbconn, $contactId);
    $trainer = getSingleTrainer($dbconn, $contactId);
    $trId = $trainer['trId'];
    $woSubCat = getTrWOs($dbconn, $trId);
    $tzip = $contact['zip'];
    $ll = getZipLL($dbconn, $tzip);

try {

    if (isset($_POST['addSched'])) {


        //Class Validators
        if ($_POST['classId'] == 0) {
            if ($_POST['woSubCatId'] == "") {
                $errors['woSubCatId'] = "Please select a work out type";
            }
            if ($_POST['level'] == "") {
                $errors['level'] = "Please select a skill level";
            }
            $desc = trim($_POST['classdescription']); //eliminate accidental space
            if (empty($desc)) {
                $errors['classdescription'] = "Please give a brief description";
            }
        }

        //location validators
        if ($_POST['newLocation'] == 0) {
            $tlname = trim($_POST['locationname']); //eliminate accidental space
            if (empty($tlname)) {
                $errors['locationname'] = 'Please create a location name you will remember.';
            } else {
                if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['locationname'])) {
                    $errors['locationname'] = 'Please use appropriate format. Letters and numbers only.';
                }
            }
            if (empty($_POST['fulladdress'])) {
                $errors['address'] = "Please enter a Google Map accepted address";
            }
        }

        //schedule validators
        if (empty($_POST['dateTime'])) {
            $errors['dateTime'] = "Please pic a date and time";
        }
        $price = trim($_POST['classPrice']);
        if (empty($price)) {
            $errors['classPrice'] = "Please set a price";
        } else {
            if (!is_numeric($_POST['classPrice'])) {  //Validate entry as number
                $errors['classPrice'] = "Please use number and decimals only";
            }
        }

        $mp = trim(($_POST['classMaxParticipants']));
        if (empty($mp)) {
            $errors['classMaxParticipants'] = "Please set the number of students";
        } else {
            if (!is_numeric($_POST['classMaxParticipants'])) {  //Validate entry as number
                $errors['classMaxParticipants'] = "Please use numbers only";
            }
        }

        if (!$errors) {
            //Class section
            if ($_POST['classId'] == 0) {

                //set variables
                $className = mysqli_real_escape_string($dbconn, $_POST['classname']);
                $woSubCatId = mysqli_real_escape_string($dbconn, $_POST['wosubcatid']);
                $classDescription = mysqli_real_escape_string($dbconn, $_POST['classdescription']);
                $level = mysqli_real_escape_string($dbconn, $_POST['level']);

                //add to db
                $sqlInsertClass = "INSERT INTO class (contactId, woSubCatId, classDescription, level)
                                   VALUES ('$contactId', '$woSubCatId', '$classDescription', '$level')";
                $dbconn->query($sqlInsertClass);

                //Get last id
                $lastInserted= mysqli_insert_id($dbconn);
                $classId = $lastInserted;

            } else {
                $classId = $_POST['classId'];
            } //end class section

            //Location section
            if ($_POST['newLocation'] == 0) {

                //get address parts from google map address
                $gadd = ($_POST['fulladdress']);
                $gaddsep = explode(",", $gadd);
                $sz = explode(" ", $gaddsep[2]);

                //get latlng
                $waddress = $gaddsep[0] . "+" .$gaddsep[1] ."+" .$sz[1] ."+" .$sz[2];
                $prepAddr = str_replace(' ','+',$waddress);
                $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
                $output= json_decode($geocode);
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;

                //set variables
                $locationName = mysqli_real_escape_string($dbconn, $_POST['locationname']);
                $address = mysqli_real_escape_string($dbconn, $gaddsep[0]);
                $city = mysqli_real_escape_string($dbconn, $gaddsep[1]);
                $state = mysqli_real_escape_string($dbconn, $sz[1]);
                $zip = mysqli_real_escape_string($dbconn, $sz[2]);


                //add to db
                $sqlInsertLocation = "INSERT INTO classLocations (contactId, locationName, address, city, state, zip, latitude, longitude)
                                      VALUES ('$contactId', '$locationName', '$address', '$city', '$state', '$zip', '$latitude', '$longitude')";
                $dbconn->query($sqlInsertLocation);

                //get last id
                $lastInserted= mysqli_insert_id($dbconn);
                $classLocationId = $lastInserted;

            } else {
                $classLocationId = $_POST['newLocation'];
            }//end location section

            //Scheduled Class Section
            //set variables
            $classStart = $_POST['dateTime'];
            $classEnd = date('Y-m-d H:i:s', strtotime($classStart . ' 1 hour'));
            $ct = explode(" ", $classStart);  //Separate time from date
            $classTime = $ct[1]; //Get time for final db entry
            $classPrice = mysqli_real_escape_string($dbconn, $_POST['classPrice']);
            $classMaxParticipants = mysqli_real_escape_string($dbconn, $_POST['classMaxParticipants']);
            if (isset($_POST['isRecur'])) {
                $isRecur = 'yes';
            } else {
                $isRecur = 'no';
            }

            if ($isRecur == 'yes') {
                $step  = 1;  //number of units for recurrence
                //create recurrence id to manage group
                $sqlInsertRecur = "INSERT INTO recurSched (contactId) VALUE ($contactId)";
                $dbconn->query($sqlInsertRecur);
                $lastInsertedR = mysqli_insert_id($dbconn);
                $recurId = $lastInsertedR;
                $runtime = $_POST['futint'];
                $start = new DateTime($classStart);
                $end   = clone $start;


                if ($_POST['recur'] !== '0') {
                    $dow = date('l', strtotime($classStart));
                    $unit  = $_POST['recur'];

                    $start->modify($dow); // Move to first occurence
                    $end->add(new DateInterval($runtime)); // Set interval period.  'P' for period.  'T' if included is for time. '1' sets amount of interval. 'Y' identifies duration quantity eg year.

                    $interval = new DateInterval("P{$step}{$unit}");
                    $period   = new DatePeriod($start, $interval, $end);

                    foreach ($period as $date) {
                        $schedDate = $date->format('Y-m-d') ." " .$classTime;
                        $classEnd = date('Y-m-d H:i:s', strtotime($schedDate . ' 1 hour'));
                        //insert into db
                        $sqlInsertSch = "INSERT INTO classScheduled (classId, contactId, classLocationId, start, end, classPrice, classMaxParticipants, recurId)
                                         VALUES ('$classId', '$contactId', '$classLocationId', '$schedDate', '$classEnd', '$classPrice', '$classMaxParticipants', '$recurId')";
                        $dbconn->query($sqlInsertSch);
                    }
                    header("location:trSchGroupClass.php?contactId=$contactId");

                } else {
                    $dayarray = $_POST['dayVar'];
                    foreach ($dayarray AS $key => $n) {
                        $dow = $n;
                        $unit = 'W';

                        $start->modify($dow); // Move to first occurence
                        $end->add(new DateInterval($runtime)); // Set interval period.  'P' for period.  'T' if included is for time. '1' sets amount of interval. 'Y' identifies duration quantity eg year.

                        $interval = new DateInterval("P{$step}{$unit}");
                        $period   = new DatePeriod($start, $interval, $end);

                        foreach ($period as $date) {
                            $schedDate = $date->format('Y-m-d') ." " .$classTime;
                            $classEnd = date('Y-m-d H:i:s', strtotime($schedDate . ' 1 hour'));
                            $sqlInsertSch = "INSERT INTO classScheduled (classId, contactId, classLocationId, start, end, classPrice, classMaxParticipants, recurId)
                                         VALUES ('$classId', '$contactId', '$classLocationId', '$schedDate', '$classEnd', '$classPrice', '$classMaxParticipants', '$recurId')";
                            $dbconn->query($sqlInsertSch);
                        }
                    }
                    header("location:trSchGroupClass.php?contactId=$contactId");
                }
            } else {
                //add to db
                $sqlInsertSched = "INSERT INTO classScheduled (classId, contactId, classLocationId, start, end, classPrice, classMaxParticipants)
                                   VALUES ('$classId', '$contactId', '$classLocationId', '$classStart', '$classEnd', '$classPrice', '$classMaxParticipants')";
                $dbconn->query($sqlInsertSched);
                header("location:trSchGroupClass.php?contactId=$contactId");
            }
        }
    }



} catch (Exception $e) {
    echo $e->getMessage();
}