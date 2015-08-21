<?php
    error_reporting(E_ALL);
    $errors = array();

    if (isset($_GET['email'])) {
        $email = $_GET['email'];
    }

    if (isset($_GET['zip'])) {
        $zip = $_GET['zip'];
    }

//    $today = date("Y/m/d");

try {

    if (isset($_POST['signUp'])) {
        //password strength validation
        $tpw = trim($_POST['pwd']); //eliminate accidental space
        if (empty($tpw)) {
            $errors['password'] = 'Please create a password';
        } elseif ($_POST['pwd'] !== $_POST['pwd2']) {
            $errors['password'] = 'Passwords do not match';
        } else {
            if (!preg_match("/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $_POST['pwd'])) {
                $errors['password'] = 'Must contain upper and lower case letter, numbers, and special characters.';
            }
        }
//        //validators
        $tfn = trim($_POST['firstName']); //eliminate accidental space
        if (empty($tfn)) {
            $errors['firstName'] = 'Please give us your First Name.';
        } else {
            if (!preg_match('/^[a-zA-Z\s]*$/', $_POST['firstName'])) {
                $errors['firstName'] = 'Letters and spaces only please.';
            }
        }
        $tln = trim($_POST['lastName']); //eliminate accidental space
        if (empty($tfn)) {
            $errors['lastName'] = 'Please give us your Last Name.';
        } else {
            if (!preg_match('/^[a-zA-Z\s]*$/', $_POST['lastName'])) {
                $errors['lastName'] = 'Letters and spaces only please.';
            }
        }
        if ($_POST['gender'] == 'Select a gender') {
            $errors['gender'] = 'Please select a gender.';
        }


        if (!$errors) {
            //set variables
            $firstName = mysqli_real_escape_string($dbconn, trim($_POST['firstName']));
            $lastName = mysqli_real_escape_string($dbconn, trim($_POST['lastName']));
            $gender = $_POST['gender'];
            $birthDate = date('Y-m-d', strtotime($_POST['birthDate']));
            $pwd = md5($_POST['pwd']);

            //add record to contact table
            $sqlInsertC = "INSERT INTO contacts (firstName, lastName, zip, birthDate, gender) VALUES ('$firstName', '$lastName', '$zip', '$birthDate', '$gender')";
            $dbconn->query($sqlInsertC);

            //get contactId from contact table
            $lastInserted= mysqli_insert_id($dbconn);
            $contactId = $lastInserted;

            //add login to access table
            $sqlInsertAL = "INSERT INTO access (contactId, pwd, email, accessLevel) VALUES ('$contactId', '$pwd', '$email', 'customer')";
            $dbconn->query($sqlInsertAL);

            //email thank you to customer
            $to = $email;
            $subject = "Welcome to FYTME";
            $message = "Thank you " .$firstName ." for joining FYTME.  Here is some other stuff you need to know.";
            $headers = "From: info@ftyme.net" . "\r\n";
            $headers = "BCC: stevesmith@epesent.com";

            mail($to,$subject,$message);
            header("location:cusHome.php?contactId=$contactId&zip=$zip");

        }
    }
} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}