<?php
    error_reporting(E_ALL);
    if (isset($_GET['classSchedId'])) {
        $classSchedId = $_GET['classSchedId'];
    }

    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    require_once 'connectdb.php';
    $trainer = getSingleContact($dbconn, $contactId);
    $students = getStudents($dbconn, $classSchedId);
    while ($row = $students->fetch_assoc()) {
        $eadd[] = $row['email'];
    }
    $to = "undisclosed-recipients";
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = "From: " . $_POST['from'] . "\r\n";
    $headers .= 'BCC: ' . implode(', ', $eadd) . "\r\n";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Email All Registered Students</title>
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
            <div id="tspace" style="height: 50px">&nbsp;</div><!--end tspace-->
            <?php
                if ( mail($to,$subject,$message,$headers) ) {
                    echo "<h2>The email has been sent!</h2>";
                } else {
                    echo "<h2>The email has failed!</h2>";
                }
            ?>
            <p><a href="trClasses.php?contactId=<?php echo $contactId; ?>" class="reg">RETURN TO CLASSES</a></p>
        </div><!--end maincontent-->
    </div><!--end wrapper-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->

</body>
</html>
