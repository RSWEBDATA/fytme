<?php

    error_reporting(E_ALL);

    if (isset($_GET['classLocationId'])) {
        $classLocationId = $_GET['classLocationId'];
    }

    $chooseState = getAllState($dbconn);
    $location = getLocation($dbconn, $classLocationId);
    $contactId = $location['contactId'];

try {
    if (isset($_POST['edit'])) {
        //valildators
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

        //variables
        $locationName = mysqli_real_escape_string($dbconn, $_POST['locationName']);
        $address = mysqli_real_escape_string($dbconn, $_POST['address']);
        $address2 = mysqli_real_escape_string($dbconn, $_POST['address2']);
        $city = mysqli_real_escape_string($dbconn, $_POST['city']);
        $state = mysqli_real_escape_string($dbconn, $_POST['state']);
        $zip = mysqli_real_escape_string($dbconn, $_POST['zip']);

        $sqlUpdate = "UPDATE classLocations SET locationName = '$locationName', address = '$address', address2 = NULLIF ('$address2', ''), city = '$city', state = '$state', zip = '$zip'
                      WHERE classLocationId = '$classLocationId'";
        $dbconn->query($sqlUpdate);

        header("location: trClasses.php?contactId=$contactId");

    }

    if (isset($_POST['inactivate'])) {
        if (isset($_GET['classLocationId'])) {
            $classLocationId = $_GET['classLocationId'];
        }

        $sqlInactive = "UPDATE classLocations SET active = 'inactive' WHERE classLocationId = '$classLocationId'";
        $dbconn->query($sqlInactive);

        header("location: trClasses.php?contactId=$contactId");
    }

} catch (Exception $e) {
    echo $e->getMessage();
}