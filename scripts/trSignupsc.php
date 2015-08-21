<?php
    error_reporting(E_ALL);
    $errors = array();
    $chooseState = getAllState($dbconn);
    $howFoundList = gethowFound ($dbconn);


try {

    if (isset($_POST['join'])) {

        //Validators
        $tfn = trim($_POST['firstName']); //eliminate accidental space
        if (empty($tfn)) {
            $errors['firstName'] = '* First Name.';
        } else {
            if (!preg_match('/^[a-zA-Z\s]*$/', $_POST['firstName'])) {
                $errors['firstName'] = 'Letters and spaces only please.';
            }
        }

        $tln = trim($_POST['lastName']); //eliminate accidental space
        if (empty($tfn)) {
            $errors['lastName'] = '* Last Name.';
        } else {
            if (!preg_match('/^[a-zA-Z\s]*$/', $_POST['lastName'])) {
                $errors['lastName'] = 'Letters and spaces only please.';
            }
        }

        $tadd = trim($_POST['address']); //eliminate accidental space
        if (empty($tadd)) {
            $errors['address'] = '* Address';
        } else {
            if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['address'])) {
                $errors['address'] = 'Please use appropriate format.';
            }
        }

        $tcity = trim($_POST['city']); //eliminate accidental space
        if (empty($tcity)) {
            $errors['city'] = '* City';
        } else {
            if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['city'])) {
                $errors['city'] = 'Please use appropriate format.';
            }
        }

        $tzip = trim($_POST['zip']); //eliminate accidental space
        if (empty($tzip)) {
            $errors['zip'] = '* Zip Code';
        } else {
            if (!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST['zip'])) {
                $errors['zip'] = 'Please give a valid zip code.';
            }
        }

        $tphone = trim($_POST['phone']); //eliminate accidental space
        if (empty($tphone)) {
            $errors['phone'] = '* Telephone';
        } else {
            if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $_POST['phone'])) {
                $errors['phone'] = 'Please give a valid phone number.';
            }
        }

        $temail = trim($_POST['email']);
        if (empty($temail)) {
            $errors['email'] = '* Email';
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Please use a valid email format.";
            }
        }

        $tbirthdate = trim($_POST['birthDate']);
        if (empty($tbirthdate)) {
            $errors['birthDate'] = "* Birth date.";
        }

        if ($_POST['howFound'] == "") {
            $errors['howFound'] = "Please make a selection.";
        }

        if (!$errors) {  //ensure no errors and stops script if their are

            //Set variables for db entry
            $firstName = mysqli_real_escape_string($dbconn, $_POST['firstName']);
            $lastName = mysqli_real_escape_string($dbconn, $_POST['lastName']);
            $address = mysqli_real_escape_string($dbconn, $_POST['address']);
            $city = mysqli_real_escape_string($dbconn, $_POST['city']);
            $state = mysqli_real_escape_string($dbconn, $_POST['state']);
            $zip = mysqli_real_escape_string($dbconn, $_POST['zip']);
            $phone = preg_replace("/[^0-9]/", "", $_POST['phone']); //trim to only numbers
            $email = mysqli_real_escape_string($dbconn, $_POST['email']);
            $birthDate = date('Y-m-d', strtotime($_POST['birthDate']));
            $gender = mysqli_real_escape_string($dbconn, $_POST['gender']);
            $howFoundId = $_POST['howFound'];

            //add record to contacts in db
            $sqlInsert = "INSERT INTO trTemp (firstName, lastName, address, city, state, zip, phone, email, birthDate, gender, howFoundId)
                          VALUES ('$firstName', '$lastName', '$address', '$city', '$state', '$zip', '$phone', '$email', '$birthDate', '$gender', '$howFoundId')";
            $dbconn->query($sqlInsert);

            $lastInserted= mysqli_insert_id($dbconn);
            $trTempId= $lastInserted;

            //email request to admin
            $to = "stevesmith@epesent.com";
            $subject = "New trainer application";
            $message = $firstName . " " .$lastName . "wants to become a trainer with FYTME.
                His email address is " .$email ."
                His telephone number is " .$phone ."
                Click this link to see the application http://www.fytme.net/adminTrNew.php?trTempId=" .$trTempId. "&accessLevel=admin";

            mail($to,$subject,$message);

            //email thanks to applicant
            $toA = $email;
            $subjectA = "Thank you from FYTME";
            $messageA =
                "Dear " .$firstName .",
                Thank you for your interest in FytME.  We have recieved your application and are excited to have you as a potential partner.  We look forward to getting listed on  FytME.com soon. Currently, we are in the process of  getting you set up.  Please note that we will be reaching out to you either via email or phone to finalize the details. If in the meantime, you have any questions please feel free to contact us at trainers@fytme.com.  The normal turn around time is 7 to 10 business days.";
            $headers = "From: trainers@fytme.com \r\n";

            if (mail($toA,$subjectA,$messageA,$headers)) {
                header("location:trSUThanks.php");
            } else {
                echo "The email failed.";
            }
        }
    }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}