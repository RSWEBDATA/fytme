<?php
error_reporting(E_ALL);
    if (isset($_GET['trTempId'])) {
        $trTempId = $_GET['trTempId'];
    }

    $trInfo = getSpNewTr($dbconn, $trTempId);
    $trAge = getAge2($dbconn, $trTempId);


try {

    if (isset($_POST['approve'])) {
        //set variables
        $firstName = $trInfo['firstName'];
        $lastName = $trInfo['lastName'];
        $address = $trInfo['address'];
        $city = $trInfo['city'];
        $state = $trInfo['state'];
        $zip = $trInfo['zip'];
        $phone = $trInfo['phone'];
        $email = $trInfo['email'];
        $birthDate = $trInfo['birthDate'];
        $gender = $trInfo['gender'];
        $howFoundId = $trInfo['howFoundId'];
        $applicationDate = $trInfo['created'];

        //add info to contact table
        $sqlInsertC = "INSERT INTO contacts (firstName, lastName, address, city, state, zip, phone, email, birthDate, gender, howFoundId, created)
                       VALUES ('$firstName', '$lastName', '$address', '$city', '$state', '$zip', '$phone', '$email', '$birthDate', '$gender', '$howFoundId', NOW())";
        $dbconn->query($sqlInsertC);

        $lastInserted= mysqli_insert_id($dbconn);
        $contactId= $lastInserted;

        //add info to trainer table
        $sqlInsertT = "INSERT INTO trainers (contactId, applicationDate, approveDate) VALUES ('$contactId', '$applicationDate', NOW())";
        $dbconn->query($sqlInsertT);

        //email new trainer
        $to = $email;
        $subject = "Welcome to FYTME";
        $message = "Congratulations. You have been approved and accepted to be part of the FytME training squad.  Please click the following link to create your login and complete your profile. http://www.fytme.net/trAccess?contactId=" .$contactId ." Once your profile is completed, your services will be offered and you will start to get appoints without having to left a finger.  Congratulations.   We are excepted to have you as part of the FytMe squad.";
        $headers = "From: trainers@fytme.com";

        if (mail($to,$subject,$message,$headers)) {
            //delete record from trTemp
            $sqlDel = "DELETE FROM trTemp WHERE trTempId= '$trTempId'";
            $dbconn->query($sqlDel);

            header("location: adminHome.php");
        } else {
            echo "<h2>The email failed.</h2>";
        }
    }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}
