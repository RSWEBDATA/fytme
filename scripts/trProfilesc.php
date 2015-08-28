<?php
    error_reporting(E_ALL);
    $errors = array();
    require_once('ImageManipulator.php');

    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }
//    if (isset($_SESSION['accessLevel'])) {
//        $accessLevel = $_SESSION['accessLevel'];
//    }

    $contact = getSingleContact($dbconn, $contactId);
    $trainer = getSingleTrainer($dbconn, $contactId);
    $chooseState = getAllState($dbconn);
    $radius = getRadius($dbconn);
    $woType = getwoSubCat($dbconn);
    $trId = $trainer['trId'];

    if (!empty($contact['phone'])) {
        $phoneout = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $contact['phone']);
    } else {
        $phoneout = "";
    }
    if (!empty($contact['mobile'])) {
        $mobileout = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $contact['mobile']);
    } else {
        $mobileout = "";
    }
    //format date for output
    $bdo= new DateTime($contact['birthDate']);
    $birthDateOut = $bdo->format('m/d/Y');

try {

    //available hours scripts
    if (isset($_POST['avail'])) {
        //clear table of previous schedule
        $sqlDelete = "DELETE FROM availableHours WHERE trId = '$trId'";
        $dbconn->query($sqlDelete);

        //insert new schedule
        foreach ($_POST AS $k) {
            if ($k !== "Update") {

                $vari = explode("-", $k); //break value into variables
                $dow = $vari['0'];
                $start = $vari['1'];

                $sqlInsert = "INSERT INTO availableHours (trId, dow, start) VALUES ('$trId', '$dow', '$start')";
                $dbconn->query($sqlInsert);
            }
        }
        header("location:trProfile.php?contactId=$contactId");
    }

    if (isset($_POST['woadd'])) {
        //Delete previous choices
        $sqlDeleteWO = "DELETE FROM wotrJoin WHERE trId = '$trId'";
        $dbconn->query($sqlDeleteWO);

        //Insert new choices
        if (isset($_POST['wo'])) {
            $wo = $_POST['wo'];
            $i = 0;

            foreach ($wo AS $type=>$tvalue) {
                if (isset($_POST["level" .$tvalue])) {
                    $level = $_POST["level" .$tvalue];
                    foreach ($level AS $key=>$value) {

                        $sqlInsert = "INSERT INTO wotrJoin (trId, woSubCatId, level) VALUES ('$trId', '$tvalue', '$value')";
                        $dbconn->query($sqlInsert);

                    }
                } else {
                    $level = 'beginner';
                    $sqlInsert = "INSERT INTO wotrJoin (trId, woSubCatId, level) VALUES ('$trId', '$tvalue', '$level')";
                    $dbconn->query($sqlInsert);

                }
            }
            foreach ($wo AS $key => $value) {
                $i++;
            }
            header("location: trAddClass1x1.php?contactId=$contactId");
        }
    }

    if (isset($_POST['ppinfo'])) {

        //Validators
        $tfn = trim($_POST['firstName']); //eliminate accidental space
        if (empty($tfn)) {
            $errors['firstName'] = 'Please give us your First Name.';
        } else {
            if (!preg_match('/^[a-zA-Z\s]*$/', $_POST['firstName'])) {
                $errors['firstName'] = 'Letters and spaces only please.';
            }
        }

        $tln = trim($_POST['lastName']); //eliminate accidental space
        if (empty($tln)) {
            $errors['lastName'] = 'Please give us your Last Name.';
        } else {
            if (!preg_match('/^[a-zA-Z\s]*$/', $_POST['lastName'])) {
                $errors['lastName'] = 'Letters and spaces only please.';
            }
        }

        $tadd = trim($_POST['address']); //eliminate accidental space
        if (empty($tadd)) {
            $errors['address'] = 'Please give us your address';
        } else {
            if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['address'])) {
                $errors['address'] = 'Please use appropriate format.';
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

        $tphone = trim($_POST['phone']); //eliminate accidental space
        if (empty($tphone)) {
            $errors['phone'] = 'Please give us your telephone';
        } else {
            if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $_POST['phone'])) {
                $errors['phone'] = 'Please give a valid phone number.';
            }
        }

        $temail = trim($_POST['email']);
        if (empty($temail)) {
            $errors['email'] = 'Please give us a valid email format.';
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Please use a valid email format.";
            }
        }

        $tbirthdate = trim($_POST['birthDate']);
        if (empty($tbirthdate)) {
            $errors['birthDate'] = "Please give us your birth date.";
        } else {
            if (!preg_match("^(?:(1[0-2]|0[1-9])[./-](3[01]|[12][0-9]|0[1-9]))[./-][0-9]{4}$^", $_POST['birthDate'])) {
                $errors['birthDate'] = 'Please give a valid date as MM/DD/YYYY.';
            }
        }

        $tbzip = trim($_POST['baseZip']); //eliminate accidental space
        if (!empty($tbzip)){
            if (!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST['baseZip'])) {
                $errors['baseZip'] = 'Please give a valid zip code.';
            }
        }

        //picture validators
        $maxsize = 2097152; //limit size to 2 mb
        if (!empty($_FILES['fileToUpload']['name'])) {
            if (($_FILES['fileToUpload']['size'] >= $maxsize) || ($_FILES['fileToUpload']['size'] == 0)) {
                $errors['picture'] = "File too large. File must be less than 2 megabytes";
            } else {
                if ($_FILES['fileToUpload']['error'] > 0) {
                    $errors['picture'] = "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
                } else {
                    // array of valid extensions
                    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
                    // get extension of the uploaded file
                    $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
                    if (!in_array($fileExtension, $validExtensions)) {
                        $errors['picture'] = "You must upload an image file";
                    }
                }
            }
        }

        if (!$errors) {

            //picture script
            //Delete previous picture
            if (!empty($_FILES['fileToUpload']['name'])) {
                if (isset($trainer['picture'])) {
                    $target = $trainer['picture'];
                    unlink($target);
                }
                $newNamePrefix = 'conId_'.$contactId . '_';
                $piclocation = "uploads/" .$newNamePrefix .$_FILES['fileToUpload']['name']; //variable for DB
                $manipulator = new ImageManipulator($_FILES['fileToUpload']['tmp_name']);
                // resizing to 200x200J227V-G3HWJ
                $newImage = $manipulator->resample(200, 200);
                // saving file to uploads folder
                $manipulator->save('uploads/' . $newNamePrefix . $_FILES['fileToUpload']['name']);
                //update db if picutre chosen
                $sqlUpdate = "UPDATE trainers SET picture = '$piclocation' WHERE contactId = '$contactId'";
                $dbconn->query($sqlUpdate);
            }
            //Set variables for db entry
            $firstName = mysqli_real_escape_string($dbconn, trim($_POST['firstName']));
            $lastName = mysqli_real_escape_string($dbconn, trim($_POST['lastName']));
            $address = mysqli_real_escape_string($dbconn, trim($_POST['address']));
            $city = mysqli_real_escape_string($dbconn, trim($_POST['city']));
            $state = mysqli_real_escape_string($dbconn, $_POST['state']);
            $zip = mysqli_real_escape_string($dbconn, trim($_POST['zip']));
            $phone = preg_replace("/[^0-9]/", "", $_POST['phone']); //trim to only numbers
            $email = mysqli_real_escape_string($dbconn, trim($_POST['email']));
            $birthDate = date('Y-m-d', strtotime($_POST['birthDate']));
            $gender = mysqli_real_escape_string($dbconn, $_POST['gender']);
            $experience = mysqli_real_escape_string($dbconn, trim($_POST['experience']));
            $philosophy = mysqli_real_escape_string($dbconn, trim($_POST['philosophy']));
            $personalJourney = mysqli_real_escape_string($dbconn, trim($_POST['personalJourney']));
            $inspiration = mysqli_real_escape_string($dbconn, trim($_POST['inspiration']));
            $ptExpDesc = mysqli_real_escape_string($dbconn, trim($_POST['ptExpDesc']));
            $genderChoices = mysqli_real_escape_string($dbconn, $_POST['genderChoices']);
            if (isset($_POST['ptExp'])) {
                $ptExp = "yes";
            } else {
                $ptExp = 'no';
            }
            if (isset($_POST['age3to5'])) {
                $age3to5 = "yes";
            } else {
                $age3to5 = 'no';
            }
            if (isset($_POST['age6to12'])) {
                $age6to12 = "yes";
            } else {
                $age6to12 = 'no';
            }
            if (isset($_POST['13to18'])) {
                $age13to18 = "yes";
            } else {
                $age13to18 = 'no';
            }
            if (isset($_POST['age19to35'])) {
                $age19to35 = "yes";
            } else {
                $age19to35 = 'no';
            }
            if (isset($_POST['age36to65'])) {
                $age36to65 = "yes";
            } else {
                $age36to65 = 'no';
            }
            if (isset($_POST['age66up'])) {
                $age66up = "yes";
            } else {
                $age66up = 'no';
            }
            if (isset($_POST['customerHome'])) {
                $customerHome = "yes";
            } else {
                $customerHome = 'no';
            }
            $baseZip = mysqli_real_escape_string($dbconn, $_POST['baseZip']);
            if (isset($_POST['radius'])){
                $radius = $_POST['radius'];
            } else {
                $radius = '';
            }
            $advTimeReq = mysqli_real_escape_string($dbconn, $_POST['advTimeReq']);

//            //update contact database
            $sqlUpdateC = "UPDATE contacts Set firstName = '$firstName',
                                               lastName = '$lastName',
                                               address = '$address',
                                               city = '$city',
                                               state = '$state',
                                               zip = '$zip',
                                               phone = '$phone',
                                               email = '$email',
                                               birthDate = '$birthDate',
                                               gender = '$gender' WHERE contactId = '$contactId'";
            $dbconn->query($sqlUpdateC);

//            update trainer database
            $sqlUpdateTr = "UPDATE trainers SET
                              experience = NULLIF ('$experience', ''),
                              philosophy = NULLIF ('$philosophy', ''),
                              personalJourney = NULLIF ('$personalJourney', ''),
                              inspiration = NULLIF ('$inspiration', ''),
                              ptExp = '$ptExp',
                              ptExpDesc = NULLIF ('$ptExpDesc', ''),
                              genderChoices = '$genderChoices',
                              age3to5 = '$age3to5',
                              age6to12 = '$age6to12',
                              age13to18 = '$age13to18',
                              age19to35 = '$age19to35',
                              age36to65 = '$age36to65',
                              age66up ='$age66up',
                              customerHome ='$customerHome',
                              baseZip = '$baseZip',
                              radius = '$radius',
                              advTimeReq = '$advTimeReq'
                            WHERE contactId = '$contactId'";
            $dbconn->query($sqlUpdateTr);

            header("location:trProfile.php?contactId=$contactId");
        } //if !$errors end
    } //if isset submit end
}  catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}