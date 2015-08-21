<?php

error_reporting(E_ALL);
    $errors = array();


try {
    if (isset($_POST['submit'])) {
        if (empty($_POST['email'])) {
            $errors['email'] = "Please give us your email.";
        } else {
            $temail = mysqli_real_escape_string($dbconn, $_POST['email']);
            $yesE = checkEmailDup ($dbconn, $temail);
            $yesE = mysqli_fetch_assoc($yesE);

            if (empty($yesE)) {
                $errors['empty'] = "<em>We do not have your email on file.<br>Please contact us at trainer@fytme.net</em>";
            }
        }

        if (!$errors) {
            $code = rand() ."-" .$yesE['contactId'];
            $sqlInsert = "INSERT INTO pwdReset (code) VALUE ('$code')";
            $dbconn->query($sqlInsert);

            $to = $temail;
            $subject = "FYTME Link";
            $message =
                "Please go to http://fytme.net/resetPassword.php?code=" .$code ." to reset your password.  This link will only be active for 2 hours.";
            $headers = "From: trainers@fytme.com \r\n";

            if (mail($to,$subject,$message,$headers)) {
                header("location:getPassword.php?confirm");
            } else {
                echo "The email failed.";
            }
        }
    }

} catch (Exception $e) {
        echo 'Message: ', $e->getMessage(), "\n";
}