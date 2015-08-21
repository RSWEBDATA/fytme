<?php


    require_once 'connectdb.php';

    $sqlDelete = "DELETE FROM pwdReset WHERE created < NOW() - interval 2 HOUR ";
    $dbconn->query($sqlDelete);

    require_once 'scripts/resetPasswordsc.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytmness Made Easy - Reset Password</title>
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
            <form action="" method="post" id="resetForm" name="resetForm">
                <h2>Please enter a new password.</h2>
                <h5><em>(Minimum 8 characters with at least one upper and lower case letter, one number, and one special character.)</em></h5><br/>
                <input type="password" name="pwd" id="pwd" class="taMC" placeholder="New Password"/><!--used class from previous page password input-->
                <span class="error">
                    <?php
                        if ($_POST && isset($errors['pwd'])) {
                            echo $errors['pwd'];
                        }
                    ?>
                </span><br/>
                <h3>Confirm your password</h3>
                <input type="password" name="pwd2" id="pwd2" class="taMC" placeholder="Confirm Password"/>
                <span class="error">
                    <?php
                        if ($_POST && isset($errors['pwdMatch'])) {
                            echo $errors['pwdMatch'];
                        }
                    ?>
                </span><br/>
                <input type="submit" id="reset" name="reset" class="btn" value="Reset Password"/>

            </form>
        </div><!--end gpContain-->
    </div><!--end tpwrap-->
    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>
