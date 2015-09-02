<?php

    require_once 'connectdb.php';
    require_once 'scripts/indexsc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FytMe</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Petit+Formal+Script' rel='stylesheet' type='text/css'>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
        $(window).scroll(function(){
            if( $(document).scrollTop() > 500 ) {
                $('#hpbanner').fadeOut();
                $('#hpscrollbanner').fadeIn();
            } else {
                $('#hpscrollbanner').fadeOut();
                $('#hpbanner').fadeIn();
            }
        });
    </script>
    <!--modal scripts-->
    <script type="text/javascript">
        $(function() {
            $("#modDialog").dialog({
                autoOpen: false,
                width: 450,
                modal: true,
                buttons: {
                    "Log In": function() {
                        window.location = "cusLogin.php";
                    },
                    "Guest": function() {
                        window.location = "ncFilterStart.php";
                    }
                }
            });

            $("#modalOpen").click(function() {
                $("#modDialog").dialog("open");
            });
        });
    </script>
</head>

<body>
<form action="" id="enter" method="post">
    <div id="hpbanner">
        <div id="tbleft">
            <div id="logo">
                <img src="images/fytmelogosplashBIG.png" alt="Fytme Logo">
            </div><!--end logo-->
        </div><!--end tbleft-->
        <div id="tbright" style="padding-top: 15px; line-height: 10px">
            <input type="text" id="userEmail" name="userEmail" class="head" placeholder="User Email" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="password" id="pwd" name="pwd" class="head" placeholder="User Password" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" id="login" name="login" class="btn" value="Log In"/><br/>
            <h5 align="center"><a href="getPassword.php"><em>Forgot Password?</em></a></h5>
            <span class="error"><br/><br/><br/>
                <?php
                if (isset($_GET['noEntry'])) {
                    echo "<em>Please enter email address and password</em>";
                }
                ?>
            </span>
            <span class="error"><br/>
                <?php
                if (isset($_GET['noEmail'])) {
                    echo "<em>Please use the email that you registered.</em>";
                }
                ?>
            </span>
            <span class="error"><br/>
                <?php
                if (isset($_GET['pwd'])) {
                    echo "<em>We do not recognize your password.</em>";
                }
                ?>
            </span>
        </div><!--end tbright-->
    </div><!--end hpbanner-->
    <div id="hpscrollbanner">
        <div id="tbleft">
            <div id="logo">
                <img src="images/fytmelogosplashBIG.png" alt="Fytme Logo">
            </div><!--end logo-->
        </div><!--end tbleft-->
        <div id="tbrightscr">
            <input type="text" id="emailscr" name="emailscr" class="head" placeholder="User Email" />&nbsp;&nbsp;
            <input type="text" id="zipscr" name="zipscr" class="head" placeholder="Zip Code"/>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" id="signUpscr" name="signUpscr" class="btn" value="Sign Up"/>
        </div><!--end tbright-->
    </div><!--end hpscrollbanner-->
    <div id="fixlogin">
        <h2><a href="trLogin.php">TRAINER LOG IN</a></h2>
    </div>
    <div id="spacetop">&nbsp;</div><!--end spacetop-->

    <div id="panelone" class="look">
        <div id="p1maincont">
            <div id="p1mcshadow">
                <h4>
                    THE PREMIER<br/>
                    ON - DEMAND<br/>
                    FITNESS SOLUTION
                </h4>
                <h3><p>Fytness Made Easy</p></h3>
                <h2><p>
                        CONNECT TO LOCAL TRAINERS AND STUDIOS<br/>
                        BOOK SESSIONS WITH A CLICK<br/>
                        NO MEMBERSHIP, PRICING THAT FITS
                 </p></h2>

                <input type="text" id="email" name="email" class="head" placeholder="User Email" />&nbsp;&nbsp;
                <input type="text" id="zip" name="zip" class="head" placeholder="Zip Code"/>&nbsp;&nbsp;
                <input type="submit" id="signUp" name="signUp" class="btn" value="Sign Up"/>
                <span class="error"><br/><!--error section for panel signup-->
                    <?php
                    if ($_POST && isset($errors['email'])) {
                        echo $errors['email'];
                    }
                    ?>
                </span>
                <span class="error"><br/>
                    <?php
                    if ($_POST && isset($errors['zip'])) {
                        echo $errors['zip'];
                    }
                    ?>
                </span>
                <span class="error"><br/><!--error section for scroll signup-->
                    <?php
                        if ($_POST && isset($errors['emailscr'])) {
                            echo $errors['emailscr'];
                        }
                    ?>
                </span>
                <span class="error"><br/>
                    <?php
                        if ($_POST && isset($errors['zipscr'])) {
                            echo $errors['zipscr'];
                        }
                    ?>
                </span>
            </div><!--end p1mcshadow-->
        </div><!--end p1maincont-->
    </div><!--end panelone-->
</form>

<div id="paneltwo" class="look">
    <div id="pantwocont">
            <div id="p2mcshadow">
                <h4>WHY <br/>FYTME</h4>
                <ul class="list">
                    <li><h2>FROM A RELAXING YOGA CLASS IN THE SUNLIT PARK TO A HIGH INTENSITY PERSONAL TRAINING SESSION, FYTME HAS IT ALL.</h2></li>
                    <li><h2>FYTME TRAINERS WORK AT A VARIETY OF LOCATIONS AND WILL EVEN COME TO YOU.</h2></li>
                    <li><h2>DON'T WASTE MONEY ON MEMBERSHIPS. DECIDE WHEN AND WHERE YOU ATTEND SESSIONS AND PAY AS YOU GO.</h2></li>
                </ul>
            </div><!--end p2mcshadow-->
    </div><!--end pantwocont-->
</div><!--end paneltwo-->
<div id="panelfour" class="look">
    <div id="p4maincont">
        <h4>USERS</h4>
        <h3><p>The Power of Decision in Your Hands</p></h3><br/>
        <h2>
                CHOOSE A PRICE THAT FITS YOUR BUDGET<br/>
                CHOOSE A TIME THAT FITS YOUR SCHEDULE<br/>
                CHOOSE A SESSION THAT FITS YOUR NEEDS
        </h2>
        <h6><a id="modalOpen" href="#panelfour">FIND A CLASS THAT WORKS FOR YOU TODAY</a></h6>
    </div><!--end p4maincont-->
</div><!--end panelfour-->
<div id="panelthree" class="look">
    <div id="p3maincont">
        <div id="p3mcshadow">
            <h4>FUEL <br/>THE MOVEMENT</h4>
            <h3><p>Take Control of Your Career</p></h3><br/>
            <h2>AS A FYTME PERSONAL TRAINER YOU CAN:</h2>
            <ul class="list3">
                <li><h2>EXPAND YOUR CLIENTELE</h2></li>
                <li><h2>SET YOUR OWN RATES</h2></li>
                <li><h2>CHOOSE WHEN AND WHERE YOU TRAIN</h2></li>
            </ul>
            <h6><a href="trSignup.php">BECOME A FYTME TRAINER TODAY</a></h6>
        </div><!--end p3mcshadow-->
    </div><!--end p3maincont-->
</div><!--end panelthree-->
<div id="panelfive" class="look">
    <div id="p5maincont">
        <div id="p5mcshadow">
            <h4>Partners</h4>
            <h2><p>FYTME IS COMMITTED TO PROVIDING OUR USERS WITH THE BEST IN CLASS.  TO DELIVER ON THIS COMMITMENT WE ARE ACTIVELY PURSUING PARTNERSHIPS WITH
                VARIETY OF GYMS, NUTRITIONAL COMPANIES, AND APPAREL COMPANIES.</p>
            </h2>
        </div><!--end p5mcshadow-->
    </div><!--end p5maincont-->
</div><!--end panelfive-->
<div style="height: 10px"></div><!--spacer-->



<div id="modDialog" >Do you want to Login</div>



<div id="botbanner">
    <?php include_once 'includes/inc.botbanner.php'; ?>
    <div style="height: 10px"></div><!--spacer-->
</div><!--end botbanner-->

</body>
</html>