<?php

    require_once 'connectdb.php';
    require_once 'scripts/trProfilesc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytmness Made Easy - Trainers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<!--    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!--Date Picker-->
    <script type="" src="js/cusSignup.js"></script>
    <!--limit input-->
    <script language="javascript" type="text/javascript">
        //Limit textarea imput
        function limitText(limitField, limitCount, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                limitCount.value = limitNum - limitField.value.length;
            }
        }

        //show hide div on checked
        function showMe (it, box) {
            var vis = (box.checked) ? "block" : "none";
            document.getElementById(it).style.display = vis;
        }
        function showMe2 (it) {
            var vis = document.getElementById(it).style.display
            if (vis == "block") { document.getElementById(it).style.display = "none"; }
            else { document.getElementById(it).style.display = "block"; }
        }
    </script>

    <style type="text/css">
        body {
            background-image      : url("images/trsignup.jpg");
            background-attachment : fixed;
            background-position   : 50% 50%;     /* or: center center */
            background-repeat: no-repeat;
            background-size       : cover;
        }

    </style>
</head>

<body>

    <div id="topbanner">
        <?php include_once 'includes/inc.trainer.banner.php' ?>
    </div><!--end topbanner-->
    <div id="tpwrap">
        <form action="" id="main" name="main" method="post" enctype="multipart/form-data">
            <div id="tpContainer">
                <h2 align="center">UPDATE YOUR PROFILE</h2>
                <div style="height: 20px"></div><!--spacer-->
                <h2>Private</h2><h5><em>(Will not be shown to the public)</em></h5><br/>
                <div id="tr40">
                    <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['firstName'], ENT_COMPAT, 'UTF-8');} else { echo $contact['firstName']; }?>"/>
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
                        echo htmlentities($_POST['lastName'], ENT_COMPAT, 'UTF-8');} else { echo $contact['lastName']; }?>"/>
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
                        echo htmlentities($_POST['address'], ENT_COMPAT, 'UTF-8');} else { echo $contact['address']; }?>"/>
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
                        echo htmlentities($_POST['city'], ENT_COMPAT, 'UTF-8');} else { echo $contact['city']; }?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['city'])) {
                            echo $errors['city'];
                        }
                        ?>
                    </span><br/>
                </div><!--end tr87-->
                <div id="tr40">
                    <select id="state" name="state">
                        <option value="<?php echo $contact['state']; ?>"><?php echo $contact['state']; ?></option>
                        <?php foreach ($chooseState AS $rowstate) { ?>
                            <option value="<?php echo $rowstate['state_abbr']; ?>" <?php if(isset($_POST['ppinfo']) && $_POST['state'] == $rowstate['state_abbr']): ?> selected="selected" <?php endif ?>><?php echo $rowstate['state_abbr'] ?></option>
                        <?php } ?>
                    </select>
                </div><!--end tr40-->
                <div id="td40">
                    <input type="text" id="zip" name="zip" placeholder="Zip Code" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['zip'], ENT_COMPAT, 'UTF-8');} else { echo $contact['zip']; }?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['zip'])) {
                            echo $errors['zip'];
                        }
                        ?>
                    </span><br/>
                </div><!--end td40-->
                <div id="tr40">
                    <input type="text" id="phone" name="phone" placeholder="Telephone" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['phone'], ENT_COMPAT, 'UTF-8');} else { echo $phoneout; }?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['phone'])) {
                            echo $errors['phone'];
                        }
                        ?>
                    </span><br/>
                </div><!--end tr40-->
                <div id="td40">
                    <input type="text" id="email" name="email" placeholder="Email Address" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8');} else { echo $contact['email']; }?>"/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['email'])) {
                            echo $errors['email'];
                        }
                        ?>
                    </span><br/>
                </div><!--end td40-->
                <div id="tr40">
                    <input type="text" id="birthDate" name="birthDate" class="txtinput" placeholder="Birthdate" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['birthDate'], ENT_COMPAT, 'UTF-8');} else { echo $birthDateOut; }?>"/>
                    <span class="error">
                            <?php
                            if ($_POST && isset($errors['birthDate'])) {
                                echo $errors['birthDate'];
                            }
                            ?>
                    </span><br/>
                </div><!--end tr40-->
                <div id="td40">
                    <select id="gender" name="gender">
                        <option value="<?php echo $contact['gender']; ?>"><?php echo $contact['gender']; ?></option>
                        <option value="male" <?php if(isset($_POST['join']) && $_POST['gender'] == 'male'): ?> selected="selected" <?php endif ?>>Male</option>
                        <option value="female" <?php if(isset($_POST['join']) && $_POST['gender'] == 'female'): ?> selected="selected" <?php endif ?>>Female</option>
                    </select>
                </div><!--end td40-->
            </div><!--end tpContainer-->
            <div id="tpContainer">
                <h2 align="center">YOUR PUBLIC PROFILE</h2>
                <h5 align="center"><em>The following sections form your profile that will be exposed to your potential customers.
                    The more details you provide the better we can get your profile out there.</em></h5>
                <div style="height: 30px"></div><!--spacer-->
                <div id="tr66"><h3>Tell us about your experience.</h3></div><!--end tr66-->
                <div id="tr66">
                    <textarea id="experience" name="experience" class="pub" rows="16" cols="100" onkeydown="limitText(this.form.experience, this.form.countdown1, 250);" onkeyup="limitText(this.form.experience, this.form.countdown1, 250)"> <?php if(isset($_POST['ppinfo'])) { echo $_POST['experience']; }  else { echo $trainer['experience']; }?></textarea><br/>
                    <h5>(Maximum characters: 250)<br>
                        <input readonly type="text" name="countdown1" size="3" class="count" value="250"/>characters left.</h5>
                </div><!--end tr66-->
                <div id="td33">
                    <div id="trPic">
                        <?php
                        if (!$trainer['picture']) {
                            echo "<div id='biopic'><img src='images/persondef.png' style='margin: auto' alt='Upload a photo' /></div>";
                        } else {
                            echo "<img src='" .$trainer['picture'] ."'/>";
                        }
                        ?><br>
                        <label for="fileToUpload">Upload a picture</label><br /><h5><em>Must be an image file less than 2mb</em></h5><br/>
                        <input type="file" name="fileToUpload" id="fileToUpload" />
                        <span class="error">
                            <?php
                            if ($_POST && isset($errors['picture'])) {
                                echo $errors['picture'];
                            }
                            ?>
                    </span>
                    </div><!--end trPic-->
                </div><!--end td33-->
                <div id="tr66"><br/><h3>Tell us about your philosophy.</h3></div><!--end tr66-->
                <div id="tr87">
                    <textarea id="philosophy" name="philosophy" class="pub" rows="10" cols="100" onkeydown="limitText(this.form.philosophy, this.form.countdown2, 250);" onkeyup="limitText(this.form.philosophy, this.form.countdown2, 250)"> <?php if(isset($_POST['ppinfo'])) { echo $_POST['philosophy']; }  else { echo $trainer['philosophy']; }?></textarea><br/>
                    <h5>(Maximum characters: 250)<br>
                        <input readonly type="text" name="countdown2" size="3" class="count" value="250"/>characters left.</h5>
                </div><!--end tr87-->
                <div id="tr66"><br/><h3>Tell us about your personal journey.</h3></div><!--end tr66-->
                <div id="tr87">
                    <textarea id="personalJourney" name="personalJourney" class="pub" rows="10" cols="100" onkeydown="limitText(this.form.personalJourney, this.form.countdown3, 250);" onkeyup="limitText(this.form.personalJourney, this.form.countdown3, 250)"> <?php if(isset($_POST['ppinfo'])) { echo $_POST['personalJourney']; }  else { echo $trainer['personalJourney']; }?></textarea><br/>
                    <h5>(Maximum characters: 250)<br>
                        <input readonly type="text" name="countdown3" size="3" class="count" value="250"/>characters left.</h5>
                </div><!--end tr87-->
                <div id="tr66"><br/><h3>Tell us about your inspiration.</h3></div><!--end tr66-->
                <div id="tr87">
                    <textarea id="inspiration" name="inspiration" class="pub" rows="10" cols="100" onkeydown="limitText(this.form.inspiration, this.form.countdown4, 250);" onkeyup="limitText(this.form.inspiration, this.form.countdown4, 250)"> <?php if(isset($_POST['ppinfo'])) { echo $_POST['inspiration']; }  else { echo $trainer['inspiration']; }?></textarea><br/>
                    <h5>(Maximum characters: 250)<br>
                        <input readonly type="text" name="countdown4" size="3" class="count" value="250"/>characters left.</h5>
                </div><!--end tr87-->
                <div id="tr87">
                    <h3>Do you have any physical therapy experience? &nbsp;&nbsp;
                    <input type="checkbox" id="ptExp" name="ptExp" <?php if ($trainer['ptExp'] == 'yes') {echo "checked='checked'";} ?> value="yes" <?php echo (empty($_POST['ptExp'])) ? '' : 'checked' ?>/>
                    </h3>
                    <h5><em>If yes, please briefly describe your experience.</em></h5>
                </div><!--end tr87-->
                <div id="tr87">
                    <textarea id="ptExpDesc" name="ptExpDesc" class="pub" rows="10" cols="100" onkeydown="limitText(this.form.ptExpDesc, this.form.countdown5, 250);" onkeyup="limitText(this.form.ptExpDesc, this.form.countdown5, 250)"> <?php if(isset($_POST['ppinfo'])) { echo $_POST['ptExpDesc']; }  else { echo $trainer['ptExpDesc']; }?></textarea><br/>
                    <h5>(Maximum characters: 250)<br>
                        <input readonly type="text" name="countdown5" size="3" class="count" value="250"/>characters left.</h5>
                </div><!--end tr87-->
            </div><<!--end tpContainer-->
            <div id="tpContainer">
                <h2 align="center">TELL US ABOUT THE PEOPLE YOU WANT TO TRAIN</h2>
                <div style="height: 20px; clear: both"></div><!--spacer-->
                <div id="tr66">
                    <h3>Indicate the genders that you are willing to train.</h3>
                </div><!--end tr66-->
                <div id="tr33">
                    <select name="genderChoices">
                        <option value="both">Both</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div><!--end tr33-->
                <div id="tr87">
                    <br/><h3>Indicate the ages would you like to train.</h3>
                </div><!--end tr87-->
                <div id="tr15">
                    <input type="checkbox" id="age3to5" name="age3to5" <?php if ($trainer['age3to5'] == 'yes') {echo "checked='checked'";} ?> value="yes" <?php echo (empty($_POST['age3to5'])) ? '' : 'checked' ?>/>&nbsp;3 to 5
                </div><!--end tr15-->
                <div id="td15">
                    <input type="checkbox" id="age6to12" name="age6to12" <?php if ($trainer['age6to12'] == 'yes') {echo "checked='checked'";} ?> value="yes" <?php echo (empty($_POST['age6to12'])) ? '' : 'checked' ?>/>&nbsp;6 to 12
                </div><!--end td15-->
                <div id="td15">
                    <input type="checkbox" id="age13to18" name="age13to18" <?php if ($trainer['age13to18'] == 'yes') {echo "checked='checked'";} ?> value="yes" <?php echo (empty($_POST['age13to18'])) ? '' : 'checked' ?>/>&nbsp;13 to 18
                </div><!--end td15-->
                <div id="td15">
                    <input type="checkbox" id="age19to35" name="age19to35" <?php if ($trainer['age19to35'] == 'yes') {echo "checked='checked'";} ?> value="yes" <?php echo (empty($_POST['age19to35'])) ? '' : 'checked' ?>/>&nbsp;19 to 35
                </div><!--end td15-->
                <div id="td15">
                    <input type="checkbox" id="age36to65" name="age36to65" <?php if ($trainer['age36to65'] == 'yes') {echo "checked='checked'";} ?> value="yes" <?php echo (empty($_POST['age36to65'])) ? '' : 'checked' ?>/>&nbsp;36 to 65
                </div><!--end td15-->
                <div id="td15">
                    <input type="checkbox" id="age66up" name="age66up" <?php if ($trainer['age66up'] == 'yes') {echo "checked='checked'";} ?> value="yes" <?php echo (empty($_POST['age66up'])) ? '' : 'checked' ?>/>&nbsp;66+
                </div><!--end td15-->
                <div id="tr95">
                    <br/><h3>Will you travel to the customer's location?&nbsp;<input type="checkbox" id="customerHome" name="customerHome" onclick="showMe('showHide', this)" <?php if ($trainer['customerHome'] == 'yes') {echo "checked='checked'";} ?> value="yes" <?php echo (empty($_POST['customerHome'])) ? '' : 'checked' ?>/></h3><br/>
                </div><!--end tr95-->
                <div id="showHide">
                    <h3>If yes, indicate how far you will travel.</h3>
                    <ul>
                        <li><input type="radio" name="radius" class="rad" <?php if($trainer['radius'] == '1') {echo "checked='checked'";} ?> value="1"/>1 mile</li>
                        <li><input type="radio" name="radius" class="rad" <?php if($trainer['radius'] == '5') {echo "checked='checked'";} ?> value="5"/>5 miles</li>
                        <li><input type="radio" name="radius" class="rad" <?php if($trainer['radius'] == '10') {echo "checked='checked'";} ?> value="10"/>10 miles</li>
                        <li><input type="radio" name="radius" class="rad" <?php if($trainer['radius'] == '15') {echo "checked='checked'";} ?> value="15"/>15 miles</li>
                        <li><input type="radio" name="radius" class="rad" <?php if($trainer['radius'] == '20') {echo "checked='checked'";} ?> value="20"/>20 miles</li>
                        <li><input type="radio" name="radius" class="rad" <?php if($trainer['radius'] == '150') {echo "checked='checked'";} ?> value="150"/>Over 20 miles</li>
                    </ul> <br/>
                    <h3>If yes, what will be your home base zip code?&nbsp;<input type="text" id="baseZip" name="baseZip" class="taMC" style="width: 12%" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['baseZip'], ENT_COMPAT, 'UTF-8');} else { echo $trainer['baseZip']; }?>" /></h3>
                    <span class="error">
                            <?php
                            if ($_POST && isset($errors['baseZip'])) {
                                echo $errors['baseZip'];
                            }
                            ?>
                    </span><br/>
                </div><!--end showHide-->
                <div id="tr87">
                    <h3>How much time do you require before a reservation.<span><em>(hours and minutes)</em></span>&nbsp;&nbsp;
                        <select name="advTimeReq" style="width: 30%">
                            <?php if (empty($trainer['advTimeReq'])) { ?>
                                <option value="">--Select--</option>
                            <?php } else { ?>
                                <option value="<?php echo $trainer['advTimeReq']; ?>"><?php echo $trainer['advTimeReq']; ?></option>
                            <?php } ?>
                            <?php
                            for($hours=0; $hours<=48; $hours++) // the interval for hours is '1'
                                for($mins=0; $mins<60; $mins+=30) // the interval for mins is '30'
                                    echo "<option>".str_pad($hours,2,'0',STR_PAD_LEFT).":"
                                        .str_pad($mins,2,'0',STR_PAD_LEFT)."</option>";
                            ?>
                        </select>
                    </h3>
                </div><!--end tr87-->
                <div id="tr95">
                    <br><input type="submit" id="ppinfo" name="ppinfo" class="btn" Value="Update Private/Personal Information"/>
                </div><!--end tr95-->
            </div><!--end tpContainer-->
        </form><!--end form main-->
        <form action="" method="post" id="wouts" name="wouts">
            <div id="tpContainer">
                <h2 align="center">CHOOSE THE WORKOUT TYPES THAT YOU WANT TO TEACH</h2>
                <h5 align="center"><em>(Please select one or all of the difficulty levels for each workout. Beginner is the default)</em></h5>
                <div style="height: 20px; clear: both"></div><!--spacer-->
                <table id="woType" width="80%" align="center">
                    <tr>
                        <th>Work Out Type</th>
                        <th colspan="3">Levels</th>
                    </tr>
                    <?php foreach ($woType AS $row) { ?>
                        <tr>
                            <?php $woSubCatId = $row['woSubCatId'];
                            $sqlC = "SELECT * FROM wotrJoin WHERE trId = '$trId' AND woSubCatId = '$woSubCatId'";
                            $resultC = $dbconn->query($sqlC);
                            $wosC = mysqli_fetch_assoc($resultC);
                            if ($wosC) { ?>
                                <td class="tbkgnd"><input type="checkbox" name="wo[]" checked="checked" value="<?php echo $row['woSubCatId']; ?>"/> &nbsp;&nbsp;<?php echo $row['woSubCatName']; ?></td>
                            <?php } else { ?>
                                <td class="tbkgnd"><input type="checkbox" name="wo[]"value="<?php echo $row['woSubCatId']; ?>"/> &nbsp;&nbsp;<?php echo $row['woSubCatName']; ?></td>
                            <?php }
                            $woSubCatId = $row['woSubCatId'];
                            $sqlT = "SELECT * FROM wotrJoin WHERE trId = '$trId' AND woSubCatId = '$woSubCatId' AND level = 'beginner'";
                            $result = $dbconn->query($sqlT);
                            $wos = mysqli_fetch_assoc($result);
                            if ($wos['level'] === 'beginner') { ?>
                                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" checked="checked" value="beginner"/> &nbsp;&nbsp;Beginner</td>
                            <?php } else { ?>
                                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" value="beginner"/> &nbsp;&nbsp;Beginner</td>
                            <?php }
                            $woSubCatId = $row['woSubCatId'];
                            $sqlI = "SELECT * FROM wotrJoin WHERE trId = '$trId' AND woSubCatId = '$woSubCatId' AND level = 'intermediate'";
                            $resultI = $dbconn->query($sqlI);
                            $woI = mysqli_fetch_assoc($resultI);
                            if ($woI['level'] === 'intermediate') { ?>
                                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" checked="checked" value="intermediate"/> &nbsp;&nbsp;Intermediate</td>
                            <?php } else { ?>
                                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" value="intermediate"/> &nbsp;&nbsp;Intermediate</td>
                            <?php }
                            $woSubCatId = $row['woSubCatId'];
                            $sqlA = "SELECT * FROM wotrJoin WHERE trId = '$trId' AND woSubCatId = '$woSubCatId' AND level = 'advanced'";
                            $resultA = $dbconn->query($sqlA);
                            $woA = mysqli_fetch_assoc($resultA);
                            if ($woA['level'] === 'advanced') { ?>
                                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" checked="checked" value="advanced"/> &nbsp;&nbsp;Advanced</td>
                            <?php } else { ?>
                                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" value="advanced"/> &nbsp;&nbsp;Advanced</td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
                <div id="tr95">
                    <br><input type="submit" id="woadd" name="woadd" class="btn" Value="Add/Edit Workouts"/>
                </div><!--end tr95-->
            </div><!--end tpContainer-->
        </form><!--end form wouts-->
        <form action="" method="post" id="availhours" name="availhours">
            <div id="tpContainer"><!--Available Hours table-->
                <h2 align="center">SET THE HOURS YOU WILL BE AVAILABLE EACH WEEK</h2>
                <div style="height: 20px; clear: both"></div><!--spacer-->
                <div>
                    <table id="available" width="90%" align="center">
                        <tr>
                            <th>Time</th>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                        <?php

                        $days = array(0, 1, 2, 3, 4, 5, 6,);
                        $i=6;
                        while ($i <= 21 ) {
                            $ni = date("g:i", strtotime("$i:00")); //put hour in time format
                            ?>
                            <tr>
                                <td align="center"><?php echo $ni; ?></td>
                                <?php foreach ($days AS $rowD=>$valueD) {
                                    //Check for previous schedule
                                    if ($i < 10) {
                                        $st = '0' .$i .':00:00';
                                    } else {
                                        $st = $i .':00:00';
                                    }
                                    $sqlAH = "SELECT dow, start FROM availableHours WHERE trId = '$trId' AND dow = '$valueD' AND start = '$st'";
                                    $AH = $dbconn->query($sqlAH);
                                    if ($AH) {
                                        $res = mysqli_fetch_assoc($AH);
                                    }
                                    //If previous schedule set checked to "checked"
                                    ?>
                                    <td class="bord">
                                        <input type="checkbox" id="<?php echo $valueD .$i; ?>" name="<?php echo $valueD .$i; ?>" class="ah"
                                             <?php if ($res) { ?>
                                                <?php if ($res['dow'] == $valueD AND $res['start'] == $st) {
                                                    echo "checked='checked'";
                                                }
                                             } ?>
                                               value="<?php if ($i < 10) { echo $valueD .'-0' .$i .':00:00';} else {echo $valueD .'-' .$i .':00:00';} ?>" style="display: none"/>
                                        <label for="<?php echo $valueD .$i; ?>" class="ah">&nbsp;</label>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php $i++; } ?>
                    </table>
                </div><!--end table div-->
                <div id="tr95">
                    <br><input type="submit" id="avail" name="avail" class="btn" Value="Update"/>
                </div><!--end tr95-->
            </div><!--end tpContainer-->
            <div style="height: 60px"></div><!--spacer-->
        </form>
    </div><!--end tpwrap-->

    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>