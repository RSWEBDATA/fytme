<?php

    error_reporting(E_ALL);
    $errors = array();

    if (isset($_GET['classSchedId'])) {
        $classSchedId = $_GET['classSchedId'];
    }

    $chooseState = getAllState($dbconn);
    $majorCat = getMajorCategories($dbconn);
    $subCat = getSubCategories($dbconn);
    $schedClass = getSchClassAllInfo($dbconn, $classSchedId);
    $numReg = getCountParticipants($dbconn, $classSchedId);

    $contactId = $schedClass['contactId'];
    $allTrLocate = getAllTrLocations($dbconn, $contactId);

    $datetime = strtotime($schedClass['classDateTime']);
    $date = date('M/d/Y', $datetime);
    $time = date('h:i a', $datetime);

try {

    if (isset($_POST['edit'])) {
        if ($_POST['classMaxParticipants'] < $numReg['total']) {
            $errors['classMaxParticipants'] = "You have more students registered than your new maximum number.";
        }

        //validators
        if (!is_numeric($_POST['classPrice'])) {
            $errors['classPrice'] = "Numbers only please";
        }

        if (!is_numeric($_POST['classMaxParticipants'])) {
            $errors['classMaxParticipants'] = "Numbers only please";
        }

        //Location validators
        if ($_POST['location'] == 'new') {
            $tlname = trim($_POST['locationName']); //eliminate accidental space
            if (empty($tlname)) {
                $errors['locationName'] = 'Please create a class name you will remember.';
            } else {
                if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['locationName'])) {
                    $errors['locationName'] = 'Please use appropriate format. Letters and numbers only.';
                }
            }

            $tadd = trim($_POST['address']); //eliminate accidental space
            if (empty($tadd)) {
                $errors['address'] = 'Please give us the address';
            } else {
                if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['address'])) {
                    $errors['address'] = 'Please use appropriate format.';
                }
            }

            $tadd2 = trim($_POST['address2']); //eliminate accidental space
            if (!empty($tadd2)) {
                if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['address2'])) {
                    $errors['address2'] = 'Please use appropriate format.';
                }
            }

            $tcity = trim($_POST['city']); //eliminate accidental space
            if (empty($tcity)) {
                $errors['city'] = 'Please give us your city';
            } else {
                if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['city'])) {
                    $errors['city'] = 'Please use appropriate format.';
                }
            }

            $tzip = trim($_POST['zip']); //eliminate accidental space
            if (empty($tadd)) {
                $errors['zip'] = 'Please give us your Zip Code';
            } else {
                if (!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST['zip'])) {
                    $errors['zip'] = 'Please give a valid zip code.';
                }
            }
        }

        if (!$errors) {
            if ($_POST['location'] == 'new') {
                //set variables
                $locationName = mysqli_real_escape_string($dbconn, $_POST['locationName']);
                $address = mysqli_real_escape_string($dbconn, $_POST['address']);
                $address2 = mysqli_real_escape_string($dbconn, $_POST['address2']);
                $city = mysqli_real_escape_string($dbconn, $_POST['city']);
                $state = mysqli_real_escape_string($dbconn, $_POST['state']);
                $zip = mysqli_real_escape_string($dbconn, $_POST['zip']);

                //add to db
                $sqlInsertLocation = "INSERT INTO classLocations (contactId, locationName, address, address2, city, state, zip)
                                      VALUES ('$contactId', '$locationName', '$address', NULLIF ('$address2', ''), '$city', '$state', '$zip')";
                $dbconn->query($sqlInsertLocation);

                //get last id
                $lastInserted= mysqli_insert_id($dbconn);
                $classLocationId = $lastInserted;

            }  else {
                $classLocationId = $_POST['location'];
            }//end location section

            //schedule variables
            $classDateTime = $_POST['dateTime'];
            $classPrice = mysqli_real_escape_string($dbconn, $_POST['classPrice']);
            $classMaxParticipants = mysqli_real_escape_string($dbconn, $_POST['classMaxParticipants']);

            $sqlUpdate = "UPDATE classScheduled SET classLocationId = '$classLocationId', classDateTime = '$classDateTime', classPrice = '$classPrice',
                          classMaxParticipants = '$classMaxParticipants' WHERE classSchedId = '$classSchedId'";
            $dbconn->query($sqlUpdate);

            header("location: trEditSchClass.php?classSchedId=$classSchedId");
        }
    }

    if (isset($_POST['delete'])) {
        if (isset($_GET['classSchedId'])) {
            $classSchedId = $_GET['classSchedId'];
        }
        $sqlDelete = "DELETE FROM classScheduled WHERE classSchedId = '$classSchedId'";
        $dbconn->query($sqlDelete);

        header("location:trClasses.php?contactId=$contactId");
    }



} catch (Exception $e) {
    echo $e->getMessage();
}