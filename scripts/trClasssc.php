<?php

error_reporting(E_ALL);

    $errors = array();

    if (isset($_GET['classId'])) {
        $classId = $_GET['classId'];
    }

    $class = getClass($dbconn, $classId);
    $contactId = $class['contactId'];
    $getSpecSubCat = getSingleSubCat($dbconn, $class['subClassCatId']);
    $subCat = getSubCategories($dbconn);

try {

    if (isset($_POST['editClass'])) {
        //validators
        $tname = trim($_POST['className']); //eliminate accidental space
        if (empty($tname)) {
            $errors['className'] = 'Please create a class name you will remember.';
        } else {
            if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['className'])) {
                $errors['className'] = 'Please use appropriate format. Letters and numbers only.';
            }
        }

        //set variables
        $className = mysqli_real_escape_string($dbconn, $_POST['className']);
        $subClassCatId = $_POST['subClassCatId'];
        $classDescription = mysqli_real_escape_string($dbconn, $_POST['classDescription']);

        $sqlEditClass = "UPDATE class SET className='$className', subClassCatId = '$subClassCatId', classDescription = '$classDescription' WHERE classId = '$classId'";
        $dbconn->query($sqlEditClass);

        header("location: trClasses.php?contactId=$contactId");

    }//end if post edit class

    if (isset($_POST['delClass'])) {

        $sqlDelClass = "UPDATE class SET active='inactive' WHERE classId = '$classId'";
        $dbconn->query($sqlDelClass);

        header("location: trClasses.php?contactId=$contactId");
    }//end if post delete class

    if (isset($_POST['cancel'])) {

        header("location: trClasses.php?contactId=$contactId");
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
