<?php

    require_once 'connectdb.php';
    require_once 'scripts/getPasswordsc.php';

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytmness Made Easy - Trainers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <style type="text/css">
        body {
            background-color: #bc9e69;
        }
    </style>

</head>
<body>
    <div id="topbanner">
        <div id="tbleft">
            <div id="logo">
                <a href="index.php"><img src="images/fytmelogosplashBIG.png" alt="Fytme Logo"></a>
            </div><!--end logo-->
        </div><!--end tbleft-->
        <div id="tbright">
            <ul class="tbnav">
                <li><a href="indexN.php" class="tblink">HOME</a></li>
            </ul>
        </div><!--end tbright-->
    </div><!--end topbanner-->
    <div id="tpwrap">
        <div id="gpContain">
            <form action="" method="POST">
                <h2>Please enter your registered email address</h2><br/>
                <input type="text" id="email" name="email" placeholder="Email Address"/>
                <span class="error">
                    <?php
                        if ($_POST && isset($errors['email'])) {
                            echo $errors['email'];
                        }
                    ?>
                </span><br/>
                <input type="submit" name="submit" id="submit" class="btn" value="Submit"/><br/><br/>
                <h3 align="center"><em>A link will be sent to your email address. The link will be active for 2 hours.</em></h3>
            </form><br/>
            <span class="error">
                <?php
                    if ($_POST && isset($errors['empty'])) {
                        echo $errors['empty'];
                    }
                ?>
            </span>
            <span class="error">
                <?php
                    if (isset($_GET['confirm'])) {
                        echo "A link has been sent to your email address.";
                    }
                ?>
            </span>
             <span class="error">
                <?php
                if (isset($_GET['expired'])) {
                    echo "The link has expired please resubmit form for a new link.";
                }
                ?>
            </span>

        </div><!--end gpContain-->
    </div><!--end tpwrap-->
    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>

