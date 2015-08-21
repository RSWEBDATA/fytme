<?php
error_reporting(E_ALL);

    // include ImageManipulator class
    require_once('ImageManipulator.php');
    require_once 'connectdb.php';

    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }
    $trainer = getSingleTrainer($dbconn, $contactId);


    $maxsize = 2097152; //limit size to 2 mb
    if (($_FILES['fileToUpload']['size'] >= $maxsize) || ($_FILES['fileToUpload']['size'] == 0)) {
        echo "File too large. File must be less than 2 megabytes";
    } else {
        if ($_FILES['fileToUpload']['error'] > 0) {
            echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
        } else {
            // array of valid extensions
            $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
            // get extension of the uploaded file
            $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
            // check if file Extension is on the list of allowed ones
            if (in_array($fileExtension, $validExtensions)) {
                $newNamePrefix = 'conId_'.$contactId . '_';
                $manipulator = new ImageManipulator($_FILES['fileToUpload']['tmp_name']);
                // resizing to 200x200J227V-G3HWJ
                $newImage = $manipulator->resample(200, 200);
                // saving file to uploads folder
                $manipulator->save('uploads/' . $newNamePrefix . $_FILES['fileToUpload']['name']);

                if (isset($trainer['picture'])) {
                    $target = $trainer['picture'];
                    unlink($target);
                }

                $piclocation = "uploads/" .$newNamePrefix .$_FILES['fileToUpload']['name'];
                $sqlUpdate = "UPDATE trainers SET picture = '$piclocation' WHERE contactId = '$contactId'";
                $dbconn->query($sqlUpdate);

                header("location:trProfile.php?contactId=$contactId");

            } else {
                echo 'You must upload an image...';
            }


        }
    }