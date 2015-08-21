<?php

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['pwd'])) {
        $pword = md5($_POST['pwd']);
    }
    require_once '../connectdb.php';

try {
    if (empty($_POST['email']) || empty($_POST['pwd'])) {
        header("location: trLogin.php?noEntry");
    } elseif ($email) {
        $result = mysqli_query($dbconn, "SELECT * FROM access WHERE email='$email'");
        $user = mysqli_fetch_assoc($result);
        $contactId = $user['contactId'];

        if (empty($user)) {
            header("location: trLogin.php?email");
        } else {
            if ($pword !== $user['pwd']) {
                header("location: trLogin.php?pwd");
            } else {
                session_start();
                $_SESSION['accessLevel'] = $user['accessLevel'];
                header("location: trDashboard.php?contactId=$contactId");
            }
        }
    }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}