<?php
    $errors = array();

    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    if (isset($_GET['woMajorId'])) {
        $woMajorId = $_GET['woMajorId'];
    }

    if (isset($_GET['classType'])) {
        $classType = $_GET['classType'];
    }


    $wo = getWobyMajCat ($dbconn, $woMajorId);

try {

    if (isset($_POST['filt2sub'])) {
        if ($_POST['woSubCatId'] == "") {
            $errors['woSubCatId'] = "Please select a work out";
        } else {
            $woSubCatId = $_POST['woSubCatId'];
            $guest = $_POST['guest'];
            if (isset($contactId)) {
                header("location: filter3.php?woSubCatId=$woSubCatId&classType=$classType&guest=$guest&contactId=$contactId");
            } else {
                header("location: filter3.php?woSubCatId=$woSubCatId&classType=$classType&guest=$guest");
            }
        }
    }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}

