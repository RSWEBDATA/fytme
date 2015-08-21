<?php

    require_once 'connectdb.php';
    require_once 'scripts/trSignupsc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytness Made Easy - Join us as a trainer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!--Date Picker-->
    <script type="" src="js/cusSignup.js"></script>
    <script type="text/javascript">
        EnableSubmit = function(val)
        {
            var sbmt = document.getElementById("join");

            if (val.checked == true)
            {
                sbmt.disabled = false;
            }
            else
            {
                sbmt.disabled = true;
            }
        };
    </script>
    <style type="text/css">

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
    <div id="wrapper">
        <div id="suForm">
            <a href="trLogin.php" class="tblink">
                <div style="color:#ffffff; background-color: #606060; height: 30px; width: 70%; margin: 0 auto 0 auto; padding-top: 10px" align="center"><h3>LOGIN TO YOUR ACCOUNT</h3></div>
            </a><br/>
            <h5 align="center">--CREATE A NEW ONE--</h5><br/>
            <form action="" id="fmSignup" method="post">
                <div id="tr40">
                    <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['firstName'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error">
                            <?php
                            if ($_POST && isset($errors['firstName'])) {
                                echo $errors['firstName'];
                            }
                            ?>
                    </span><br/>
                </div><!--end tr40-->
                <div id="td40">
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['lastName'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error">
                            <?php
                            if ($_POST && isset($errors['lastName'])) {
                                echo $errors['lastName'];
                            }
                            ?>
                    </span><br/>
                </div><!--end td40-->
                <div id="tr87">
                    <input type="text" id="address" name="address" placeholder="Address" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['address'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error">
                            <?php
                            if ($_POST && isset($errors['address'])) {
                                echo $errors['address'];
                            }
                            ?>
                    </span><br/>
                </div><!--end tr87-->
                <div id="tr87">
                    <input type="text" id="city" name="city" placeholder="City" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['city'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['city'])) {
                            echo $errors['city'];
                        }
                        ?>
                    </span><br/>
                </div><!--end tr87-->
                <div id="tr40">
                    <select id="state" name="state" required>
                        <option value="" disabled selected>Select State</option>
                        <?php foreach ($chooseState AS $rowstate) { ?>
                            <option value="<?php echo $rowstate['state_abbr']; ?>" <?php if(isset($_POST['join']) && $_POST['state'] == $rowstate['state_abbr']): ?> selected="selected" <?php endif ?>><?php echo $rowstate['state_abbr'] ?></option>
                        <?php } ?>
                    </select>
                </div><!--end tr40-->
                <div id="td40" style="margin-left: 4%">
                    <input type="text" id="zip" name="zip" class="txtinput" placeholder="Zip Code" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['zip'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['zip'])) {
                            echo $errors['zip'];
                        }
                        ?>
                    </span><br/>
                </div><!--end td40-->
                <div id="tr87">
                    <input type="text" id="phone" name="phone" placeholder="Telephone" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['phone'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['phone'])) {
                            echo $errors['phone'];
                        }
                        ?>
                    </span><br/>
                </div><!--end tr87-->
                <div id="tr40">
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="Male" <?php if(isset($_POST['join']) && $_POST['gender'] == 'Male'): ?> selected="selected" <?php endif ?>>Male</option>
                        <option value="Female" <?php if(isset($_POST['join']) && $_POST['gender'] == 'Female'): ?> selected="selected" <?php endif ?>>Female</option>
                    </select>
                </div><!--end tr40-->
                <div id="td40" style="margin-left: 4%">
                    <input type="text" id="birthDate" name="birthDate" class="txtinput" placeholder="Birthdate" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['birthDate'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error">
                            <?php
                            if ($_POST && isset($errors['birthDate'])) {
                                echo $errors['birthDate'];
                            }
                            ?>
                    </span><br/>
                </div><!--end td40-->
                <div id="tr87">
                    <input type="text" id="email" name="email" class="txtinput" placeholder="name@example.com" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['email'])) {
                            echo $errors['email'];
                        }
                        ?>
                    </span><br/>
                </div><!--end tr87-->
                <div id="tr87">
                    <select id="howFound" name="howFound" style="width: 100%" required>
                        <option value="" disabled selected>How did you hear about FYTME</option>
                        <?php foreach ($howFoundList AS $rowHF) { ?>
                            <option value="<?php echo $rowHF['howFoundId']; ?>" <?php if(isset($_POST['join']) && $_POST['howFound'] == $rowHF['howFoundId']): ?> selected="selected"  <?php endif ?>><?php echo $rowHF['howFoundName'] ?></option>
                        <?php } ?>
                    </select>
                </div><!--end td40-->
                <br/>
                <div id="tr87" align="center">
                    <input type="checkbox" name="agree" id="agree" value="agree" onclick="EnableSubmit(this)" />&nbsp;&nbsp;I have read and agree to the <br/><br/>
                    <button class="btn" onclick="window.open('pdfs/terms.pdf', '_blank')">Terms & Agreements</button>
                </div><!--end tr87-->
                <br/>
                <div id="tr87" align="center">
                    <input type="submit" name="join" id="join" class="btn" value="JOIN OUR TEAM" disabled />
                </div><!--end tr87-->
            </form>
            <div style="height: 20px"></div><!--spacer-->
        </div><!--end suForm-->
        <div id="panel1">
            <div id="p1content">
                <h1>HELP OTHERS GET FYT AS A FYTME TRAINER</h1>
                <h3>Place enticing text here for the trainers.</h3>
            </div><!--end p1content-->
            <div id="p1content2">
                <div id="phrase1">
                    <div id="phrasepics">
                        <img src="images/persondef.png" align="left" title="Placehoder image"/>
                    </div><!--end phrasepics-->
                    <div id="phrasetext">
                        <h2>Earn additional money doing what you love by setting your own rates.</h2>
                    </div><!--end phrasetext-->
                </div><!--end phrase1-->
                <div id="phrase2">
                    <div id="phrasepics">
                        <img src="images/persondef.png" title="Placehoder image"/>
                    </div><!--end phrasepics-->
                    <div id="phrasetext">
                        <h2>Carry out your fitness passion on your own time and schedule.</h2>
                    </div><!--end phrasetext-->
                </div><!--end phrase2-->
                <div id="phrase3">
                    <div id="phrasepics">
                        <img src="images/persondef.png" title="Placehoder image"/>
                    </div><!--end phrasepics-->
                    <div id="phrasetext">
                        <h2>Be your own boss and let us help you build and manage your business.</h2>
                    </div><!--end phrasetext-->
                </div><!--end phrase3-->
                <div style="height: 50px; clear: both"></div>
            </div><!--end p1content2-->
        </div><!--end panel1-->

    </div><!--end wrapper-->
    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>