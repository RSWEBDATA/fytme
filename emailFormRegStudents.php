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

            <form action="emailRegStudents.php?classSchedId=<?php echo $classSchedId; ?>&contactId=<?php echo $contactId; ?>" method="post">
                <h3>
                    TO: Undisclosed Recipients<br/>
                    BCC: <?php echo implode(", ", $eadd) ?> <br/>
                    FROM: <input type="text" id="from" name="from" style="width: 30%" value="<?php echo $trainer['email']; ?>" /><br/><br/>
                    Subject: <input type="text" id="subject" name="subject" style="width: 35%"/><br/><br/>
                    Message:<br/><textarea id="message" name="message" rows="20" cols="80"></textarea>
                </h3><br/>
                <input type="submit" id="send" class="btn" value="Send Email"/> &nbsp;&nbsp;&nbsp;
                <input type="button" id="cancel" name="cancel" class="btn" value="Go Back" onClick="history.go(-1);return true;"/>
            </form>
            <div id="bspace" style="height: 50px">&nbsp;</div><!--end bspace-->
        </div><!--end maincontent-->
    </div><!--end wrapper-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->

</body>
</html>