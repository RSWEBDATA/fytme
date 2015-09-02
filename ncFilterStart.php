<?php
error_reporting(E_ALL);

    require_once 'connectdb.php';
    $woMajor = getwoMajor ($dbconn);
    $errors = array();

try {

    if (isset($_POST['filtSubmit'])) {
        if ($_POST['woMajorId'] == "") {
            $errors['woMajorId'] = "Please select a category";
        } else {
            $woMajorId = $_POST['woMajorId'];
            $classType = $_POST['classType'];
            header("location: filter2.php?woMajorId=$woMajorId&classType=$classType");
        }
    }

} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FytMe Choose a session</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Petit+Formal+Script' rel='stylesheet' type='text/css'>
    <link href="css/cus.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        body {
            background: url("images/cusBkgnd.jpg") no-repeat fixed 50% 50%;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div id="topbanner">
        <?php include_once 'includes/inc.customer.banner.php' ?>
    </div><!--end topbanner-->

    <div id="wrapper">
        <div id="container1">
            <form action="" id="ncFilter" method="post">
                <h2>Please Select a Work Out Category<br/><br/>
                <select name="woMajorId">
                    <option value="">Select</option>
                    <?php foreach ($woMajor as $row ) {
                        echo "<option value='" .$row['woMajorId'] ."'>" .$row['woMajorName'] ."</option>";
                    } ?>
                </select>
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['woMajorId'])) {
                        echo $errors['woMajorId'];
                    }
                    ?>
                </span><br/>
                <p>
                    <input type="radio" id="classType" name="classType" class="rad" value="trainer" checked="checked"/>&nbsp;&nbsp;Search for a trainer
                    <input type="radio" id="classType" name="classType" class="rad" value="class"/>&nbsp;&nbsp;Search for a class
                </p>
                </h2>
                <input type="submit" id="filtSubmit" name="filtSubmit" class="btn" value="NEXT"/>
            </form>

        </div><!--end container1-->
    </div><!--end wrapper-->

    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->

</body>
</html>
