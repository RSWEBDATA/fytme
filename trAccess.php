<?php

require_once 'connectdb.php';
require_once 'scripts/trAccesssc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytness Made Easy - Create your login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <style type="text/css">
        body {
            /*background: #000000;*/
        }
    </style>
</head>

<body>

    <div id="topbanner">
        <div id="tbleft">
            <div id="logo">
                <img src="images/fytmelogosplashBIG.png" alt="Fytme Logo">
            </div><!--end logo-->
        </div><!--end tbleft-->
        <div id="tbright">
            <ul class="tbnav">
                <li><a href="index.php" class="tblink">HOME</a></li>
            </ul>
        </div><!--end tbright-->
    </div><!--end topbanner-->

    <div id="taWrap">
        <div id="taMainContainer">
            <h1 align="center">CREATE YOUR LOGIN</h1><br/><br/>
            <form action="" id="setAccess" method="post">
                <div id="tr87">
                    <h3>Your user name is your email.</h3>
                    <input type="text" id="email" name="email" class="taMC" value="<?php echo $contact['email'] ?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['email'])) {
                            echo $errors['email'];
                        }
                        ?>
                    </span>
                </div><!--end tr87--><br/>
                <div id="tr87">
                    <input type="password" id="pwd" name="pwd" class="taMC" placeholder="Password"/>
                    <h3><em>(Minimum 8 characters with at least one upper and lower case letter, one number, and one special character.)</em></h3>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['pwd'])) {
                            echo $errors['pwd'];
                        }
                        ?>
                    </span>
                </div><!--end tr87-->
                <br/>
                <div id="tr87">
                    <h3>Please choose two security questions</h3>
                    <select name="question1" id="question1" required>
                        <option value="" disabled selected>Select a security question</option>
                        <option>What is the maiden name of your mother?</option>
                        <option>What is the name of your favorite pet?</option>
                        <option>What is the name of your high school?</option>
                        <option>What street did you grow up on?</option>
                        <option>What is the name of a country you have visited?</option>
                    </select>
                </div><!--end tr87-->
                <br/>
                <div id="tr87">
                    <input type="text" id="answer1" name="answer1" style="width: 91%" placeholder="Answer 1"/>
                </div><!--end tr87-->
                <br/>
                <div id="tr87">
                    <select name="question2" id="question2" required>
                        <option value="" disabled selected>Select a security question?</option>
                        <option>What is the name of your elementary school?</option>
                        <option>What is the name of your childhood best friend?</option>
                        <option>Who is your favorite actor?</option>
                        <option>What is your favorite car?</option>
                        <option>Where did you meet your spouse/significant other?</option>
                    </select>
                </div><!--end tr87-->
                <br/>
                <div id="tr87">
                    <input type="text" id="answer2" name="answer2" style="width: 91%" placeholder="Answer 2"/>
                </div><!--end tr87-->
                <br/>
                <input type="submit" id="create" name="create" class="btn" value="CREATE YOUR LOGIN"/>
            </form>
        </div><!--end taMainContainer-->
        <div style="height: 40px"></div><!--spacer-->
    </div><!--end taWrap-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>