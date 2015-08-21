<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytmness Made Easy - Trainer Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript">
        //script to stop Chrome from autocomplete
        window.onload = function() {
            setTimeout(function() {
                $('#pwd').removeAttr('readonly');
            }, 2000);
        };
    </script>
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
    <div id="trLContainer">
        <div id="trLLeft">
            <div id="loginCont">
                <h2 align="center">LOGIN TO YOUR DASHBOARD</h2>
                <div style="height: 20px;"></div><!--spacer-->
                <form action="scripts/trLoginsc.php" id="login" method="post" autocomplete="off">
                    <input type="text" id="email" name="email" placeholder="EMAIL"/>
                    <span class="error">
                        <?php
                        if (isset($_GET['email'])) {
                            echo "Please use the email that you registered.";
                        }
                        ?>
                    </span><br>
                    <input type="password" id="pwd" name="pwd" class="tlog" readonly placeholder="PASSWORD"/>
                    <span class="error">
                        <?php
                        if (isset($_GET['noEntry'])) {
                            echo "<em>Please enter email address and password</em>";
                        }
                        ?>
                    </span>
                    <span class="error">
                        <?php
                        if (isset($_GET['pwd'])) {
                            echo "We do not recognize your password.";
                        }
                        ?>
                    </span><br/>
                    <input type="submit" id="submit" name="submit" class="btn" value="LOG IN"/>
                </form>
                <a href="getPassword.php">Forgot Password?</a>
            </div><!--end loginCont-->
        </div><!--end trLLeft-->
        <div id="trLRight">
            <div id="dialogCont">
                <h1 align="center">UPDATES FOR TRAINERS HERE</h1>
            </div><!--end dialogCont-->
        </div><!--end trLRight-->
    </div><!--end trLContainer-->

    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>