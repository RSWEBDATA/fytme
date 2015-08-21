<?php
    require_once 'connectdb.php';
    require_once 'scripts/cusSignupsc.php';

    $today = date("Y/m/d");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FytMe - Sign Up for Fitness</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Petit+Formal+Script' rel='stylesheet' type='text/css'>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!--Date Picker-->
    <script type="" src="js/cusSignup.js"></script>

    <style type="text/css">
        input[type=text] {
            font-size: 14px;
            border: 1px solid #08c9ff;
            box-shadow: inset 1px 1px 2px 0 #08c9ff;
        }
        input[type=password] {
            font-size: 14px;
            border: 1px solid #08c9ff;
            box-shadow: inset 1px 1px 2px 0 #08c9ff;
        }
        select {
            font-size: 14px;
            border: 1px solid #08c9ff;
            box-shadow: inset 1px 1px 2px 0 #08c9ff;
        }
    </style>
</head>

<body>
    <div id="hpbanner">
        <div id="tbleft">
            <div id="logo">
                <img src="images/fytmelogosplashBIG.png" alt="Fytme Logo">
            </div><!--end logo-->
        </div><!--end tbleft-->
    </div><!--end hpbanner-->

    <div id="spacetop">&nbsp;</div><!--end spacetop-->
    <div id="panelone" class="look">
        <div id="pancover">
            <div id="fspacer">&nbsp;</div><!--end fspacer-->
            <div id="formbkgnd">
                <p>Please give us the following information so that we may serve you better.</p>
                <div id="formsu">
                    <form action="" id="signU" name="signU" method="post">
                        <div id="tr2"><h2>First Name:&nbsp;&nbsp;
                            <input type="text" id="firstName" name="firstName" class="txtinput" placeholder="First Name" value="<?php if ($_POST && $errors) {
                                echo htmlentities($_POST['firstName'], ENT_COMPAT, 'UTF-8');}?>"/><br/>
                            <span class="error" style="font-size: 12px">
                                <?php
                                if ($_POST && isset($errors['firstName'])) {
                                    echo $errors['firstName'];
                                }
                                ?>
                            </span></h2>
                        </div><!--end tr2-->
                        <div id="td2"><h2>Last Name:&nbsp;&nbsp;
                            <input type="text" id="lastName" name="lastName" class="txtinput" placeholder="Last Name" value="<?php if ($_POST && $errors) {
                                echo htmlentities($_POST['lastName'], ENT_COMPAT, 'UTF-8');}?>"/><br/>
                            <span class="error" style="font-size: 12px;">
                                <?php
                                if ($_POST && isset($errors['lastName'])) {
                                    echo $errors['lastName'];
                                }
                                ?>
                            </span></h2>
                        </div><!--end td2-->
                        <div id="tr3"><h2>Gender:&nbsp;&nbsp;
                            <select id="gender" name="gender">
                                <option>Select a gender</option>
                                <option value="female" <?php if(isset($_POST['signUp']) && $_POST['gender'] == 'female'): ?> selected="selected" <?php endif ?>>Female</option>
                                <option value="male" <?php if(isset($_POST['signUp']) && $_POST['gender'] == 'male'): ?> selected="selected" <?php endif ?>>Male</option>
                            </select>
                            <span class="error" style="font-size: 12px">
                                <?php
                                if ($_POST && isset($errors['gender'])) {
                                    echo $errors['gender'];
                                }
                                ?>
                            </span></h2>
                        </div><!--end tr3-->
                        <div id="tr3"><h2>Birthdate:&nbsp;&nbsp;
                            <input type="text" id="birthDate" name="birthDate" value="<?php echo $today; ?>"/></h2>
                        </div><!--end tr3-->
                        <div style="height: 20px"></div><!--end spacer-->
                        <div id="tr3"><h2>Create a login.</h2><h5><span style="color: #000000">Your username is your email address.</span></h5></div><!--end tr3-->
                        <div id="tr3">
                            <h2>Enter a password</h2><h5><em style="color: #000000">(Minimum 8 characters with at least one upper and lower case letter, one number, and one special character.)</em></h5>
                            <input type="password" id="pwd" name="pwd" placeholder="Enter a password"/>
                            <span class="error" style="font-size: 12px">
                                <?php
                                    if ($_POST && isset($errors['password'])) {
                                        echo $errors['password'];
                                    }
                                ?>
                            </span>
                        </div><!--end tr3-->
                        <div id="tr3">
                            <h2>Re-enter password.<br/>
                            <input type="password" id="pwd2" name="pwd2" placeholder="Re-enter the password"/><br/></h2>
                        </div><!--end tr3-->
                        <div id="tr3"><input type="submit" id="signUp" name="signUp" class="btn" value="Sign Up"/>
                        &nbsp;&nbsp;&nbsp;<a href="index.php" class="btn"><span style="color: #ffffff">Cancel</span></a>
                        </div><!--end tr3-->
                    </form>
                </div><!--end fromsu-->
            </div><!--end formbkgnd-->
        </div><!--end pancover-->
    </div><!--end panelone-->
    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
        <div style="height: 10px"></div><!--spacer-->
    </div><!--end botbanner-->
</body>
</html>