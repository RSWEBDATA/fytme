<?php
    $errors = array();


try {

    if (isset($_POST['login'])) {
        if (isset($_POST['userEmail'])) {
            $email = $_POST['userEmail'];
        }

        if (isset($_POST['pwd'])) {
            $pword = md5($_POST['pwd']);
        }

        if (empty($_POST['userEmail']) || empty($_POST['pwd'])) {
            header("location: indexN.php?noEntry");
        } elseif ($email) {
            $result = mysqli_query($dbconn, "SELECT * FROM access WHERE email='$email'");
            $user = mysqli_fetch_assoc($result);
            $contactId = $user['contactId'];

            if (empty($user)) {
                header("location: indexN.php?noEmail");
            } else {
                if ($pword !== $user['pwd']) {
                    header("location: indexN.php?pwd");
                } else {
                    session_start();
                    $_SESSION['accessLevel'] = $user['accessLevel'];
                    if ($user['accessLevel'] == 'trainer') {
                        header("location: trDashboard.php?contactId=$contactId");
                    } else {
                        header("location: cusDashboard.php?contactId=$contactId");
                    }
                }
            }
        }
    }

    if (isset($_POST['signUpscr'])) {
        $temailscr = trim($_POST['emailscr']);
        if (empty($temailscr)) {
            $errors['emailscr'] = 'Please give us your email address.';
        } else {
            if (!filter_var($_POST['emailscr'], FILTER_VALIDATE_EMAIL)) {
                $errors['emailscr'] = "Please use a valid email format.";
            }
        }
        $tzipscr = trim($_POST['zipscr']); //eliminate accidental space
        if (empty($tzipscr)) {
            $errors['zipscr'] = 'Please give us your Zip Code';
        } else {
            if (!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST['zipscr'])) {
                $errors['zipscr'] = 'Please give a valid zip code.';
            }
        }
        if (!$errors) {
            $emailscr = mysqli_real_escape_string($dbconn, $_POST['emailscr']);
            $zipscr = mysqli_real_escape_string($dbconn, $_POST['zipscr']);
            header("location: cusSignup.php?email=$emailscr&zip=$zipscr");
        }
    }

    if (isset($_POST['signUp'])) {
        $temail = trim($_POST['email']);
        if (empty($temail)) {
            $errors['email'] = 'Please give us your email address.';
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Please use a valid email format.";
            }
        }
        $tzip = trim($_POST['zip']); //eliminate accidental space
        if (empty($tzip)) {
            $errors['zip'] = 'Please give us your Zip Code';
        } else {
            if (!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST['zip'])) {
                $errors['zip'] = 'Please give a valid zip code.';
            }
        }
        if (!$errors) {
            $email = mysqli_real_escape_string($dbconn, $_POST['email']);
            $zip = mysqli_real_escape_string($dbconn, $_POST['zip']);
            header("location: cusSignup.php?email=$email&zip=$zip");
        }

    }

} catch (Exception $e) {
    echo $e->getMessage();
}