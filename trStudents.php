<?php

    require_once 'connectdb.php';
    require_once 'scripts/trStudentssc.php';

    $datetime = strtotime($schedClass['classDateTime']);
    $date = date('M/d/Y', $datetime);
    $time = date('h:i a', $datetime);
    $contactId = $schedClass['contactId'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registered Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400|Oleo+Script' rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>

<body>

    <div id="topbanner">
        <?php include_once 'includes/inc.trainer.banner.php' ?>
    </div><!--end topbanner-->

    <div id="wrapper">
        <div id="maincontent">
            <div id="spacer" style="height: 20px">&nbsp;</div>
            <h2>Class Name:&nbsp;&nbsp;<?php echo $schedClass['className']; ?></h2>
            <div id="tr1"><h3>When:&nbsp;&nbsp;<?php echo $date ." at " .$time; ?></h3></div><!--end tr1-->
            <div id="td1"><h3>Where:&nbsp;&nbsp;<?php echo $schedClass['locationName'] ?></h3></div><!--td1-->
            <div id="td1"><h3>No. Registered:&nbsp;&nbsp;<?php echo $numReg['total']; ?></h3></div><!--end td1-->

            <div id="pspace" style="height: 60px"></div><!--end pspace-->
            <div id="tr2"><h2>Registered Students:</h2></div><!--end tr2-->
            <div id="td1"><a href="emailFormRegStudents.php?classSchedId=<?php echo $classSchedId; ?>&contactId=<?php echo $contactId; ?>" class="reg">Email Students</a></div><!--end td1-->
            <p>
                <?php
                    foreach ($students AS $rowStu) {
                        $age = getAge($rowStu['birthDate']) ?>
                        <div id="tr4"><?php echo $rowStu['firstName'] . " " .$rowStu['lastName']; ?></div><!--end tr4-->
                        <div id="td3"><?php echo "Age: " .$age;  ?></div><!--end td3-->
                        <div id="td3"><?php echo "Gender: " .$rowStu['gender'] ?></div><!--end td3-->
                        <div id="td3"><?php echo "Email: " .$rowStu['email'] ?></div><!--end td3-->
                <?php } ?>
            </p>
        </div><!--end maincontent-->
    </div><!--end wrapper-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>