<?php

error_reporting(E_ALL);
    $errors = array();
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
    }
    $yesCode = checkResetCode ($dbconn, $code);
    $prId = $yesCode['pwdResetId'];
    $split = explode("-", $code);
    $contactId = $split[1];
    if (empty($prId)) {
        header("location:getPassword.php?expired");
    }

try {
    if (isset($_POST['reset'])) {
        //password strength validation
        $tpw = trim($_POST['pwd']); //eliminate accidental space
        if (empty($tpw)) {
            $errors['pwd'] = 'Please create a password';
        } else {
            if (!preg_match("/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $_POST['pwd'])) {
                $errors['pwd'] = 'Must contain upper and lower case letter, numbers, and special characters.';
            }
        }

        if ($_POST['pwd2'] !== $_POST['pwd']) {
            $errors['pwdMatch'] = "Passwords do not match";
        }

        if (!$errors) {
            $pwd = md5($_POST['pwd']);

            $sqlUpdate = "UPDATE access SET pwd = '$pwd' WHERE contactId = '$contactId'";
            $dbconn->query($sqlUpdate);

            $result = mysqli_query($dbconn, "SELECT * FROM access WHERE contactId='$contactId'");
            $user = mysqli_fetch_assoc($result);

            if ($user['accessLevel'] == 'trainer') {
                header("location: trDashboard.php?contactId=$contactId");
            } else {
                header("location: cusDashboard.php?contactId=$contactId");
            }
        }
    }






} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}

