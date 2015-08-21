<?php

    error_reporting(E_ALL);
    $errors = array();
    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    $contact = getContact($dbconn, $contactId);

try {

    if (isset($_POST['create'])) {

        //validators
        $temail = trim($_POST['email']);
        $emailDup = checkEmailDup($dbconn, $temail);

        if (empty($temail)) {
            $errors['email'] = 'Please give us a valid email format.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please use a valid email format.";
        } else {

            if (mysqli_num_rows($emailDup) > 0) {
                $errors['email'] = "This email is already being used.";
            }
        }

        //password strength validation
        $tpw = trim($_POST['pwd']); //eliminate accidental space
        if (empty($tpw)) {
            $errors['pwd'] = 'Please create a password';
        } else {
            if (!preg_match("/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $_POST['pwd'])) {
                $errors['pwd'] = 'Must contain upper and lower case letter, numbers, and special characters.';
            }
        }

        if (!$errors) {
            //variables
            $email = mysqli_real_escape_string($dbconn, $_POST['email']);
            $pwd = md5($_POST['pwd']);
            $question1 = $_POST['question1'];
            $answer1 = mysqli_real_escape_string($dbconn, $_POST['answer1']);
            $question2 = $_POST['question2'];
            $answer2 = mysqli_real_escape_string($dbconn, $_POST['answer2']);

            $sqlInsert = "INSERT INTO access (contactId, pwd, email, accessLevel, question1, question2, answer1, answer2)
                          VALUES ('$contactId', '$pwd', '$email', 'trainer', '$question1', '$question2', '$answer1', '$answer2')";
            $dbconn->query($sqlInsert);

            $to = $email;
            $subject = "Your login has been created.";
            $message = "Thank you for creating your login with FYTME.com. If you have not done so, please go to this link http://www.fytme.net/trProfile.php?contactId=" .$contactId ." to finish your profile.";
            $headers = "From: trainers@fytme.com \r\n";

            if (mail($to,$subject,$message,$headers)) {
                header("location:trProfile.php?contactId=$contactId");
            } else {
                echo "The email failed.";
            }
        }
    }


} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}

