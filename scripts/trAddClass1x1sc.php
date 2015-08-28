<?php

error_reporting(E_ALL);
    $errors = array();
    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    $trainer = getSingleTrainer($dbconn, $contactId);
    $trId = $trainer['trId'];
    $needed = getClassesNeeded ($dbconn, $contactId, $trId);

    if (empty($needed)) {
        header("location: trProfile.php?contactId=$contactId");
    }

try {
    if (isset($_POST['addClass'])) {

        if (!$errors) {
            $input_count = count($_POST['woSubCatId']);
            for ($i = 0; $i < $input_count; $i++) {

                $woSubCatId = mysqli_real_escape_string($dbconn, $_POST['woSubCatId'][$i]);
                $classDescription = mysqli_real_escape_string($dbconn, $_POST['classDescription'][$i]);
                $level = mysqli_real_escape_string($dbconn, $_POST['level'][$i]);
                $price1x1 = mysqli_real_escape_string($dbconn, $_POST['price1x1'][$i]);

                $sqlInsert = "INSERT INTO class (contactId, woSubCatId, classDescription, level, price1x1) VALUES ('$contactId', '$woSubCatId', '$classDescription', '$level', '$price1x1')";
                $dbconn->query($sqlInsert);

            }
            header("location: trProfile.php?contactId=$contactId");
        }
    }


} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}