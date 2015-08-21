<?php

    require_once 'connectdb.php';
    require_once 'scripts/trEditSchClasssc.php';
    $numReg = getCountParticipants($dbconn, $classSchedId);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytness Made Easy - Trainer Classes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-2.0.2.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!--datetimepicker-->
    <link type="text/css" href="css/jquery.simple-dtpicker.css" rel="stylesheet" />
    <script src="js/jquery.simple-dtpicker.js"></script>
    <script type="text/javascript" src="js/trClassesjs.js"></script>
    <script type="text/javascript">
        function enableTextbox() {
            if (document.getElementById("location").value == "new") {
                document.getElementById("locationName").disabled = false;
                document.getElementById("address").disabled = false;
                document.getElementById("address2").disabled = false;
                document.getElementById("city").disabled = false;
                document.getElementById("state").disabled = false;
                document.getElementById("zip").disabled = false;
            }
            else {
                document.getElementById("locationName").disabled = true;
                document.getElementById("address").disabled = true;
                document.getElementById("address2").disabled = true;
                document.getElementById("city").disabled = true;
                document.getElementById("state").disabled = true;
                document.getElementById("zip").disabled = true;
            }
        }
    </script>
</head>

<body>
    <div id="topbanner">
        <?php include_once 'includes/inc.trainer.banner.php' ?>
    </div><!--end topbanner-->

    <div id="wrapper">
        <div id="maincontent">
            <div style="height: 45px"></div><!--spacer-->
            <div id="mcForm">
                <h2>Edit the specific schedule of a class.</h2>
                <br/>
                <form action="" method="post" id="editSched">
                    <div id="tr1">Class Name:&nbsp;&nbsp;<? echo $schedClass['className']; ?></div>
                    <div id="tr5">
                        Date/Time:&nbsp;&nbsp;<input type="text" id="dateTime" name="dateTime" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['dateTime'], ENT_COMPAT, 'UTF-8');} else {echo $schedClass['classDateTime']; }?>" />
                        <script type="text/javascript">
                            $(function(){
                                $('#dateTime').appendDtpicker({
                                    "minuteInterval": 30,
                                    "closeOnSelected": true
                                });
                            });
                        </script>
                    </div><!--end tr5-->
                    <div id="td5">
                        Price:&nbsp;&nbsp;$
                        <input type="text" id="classPrice" name="classPrice" style="width: 30px" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['classPrice'], ENT_COMPAT, 'UTF-8');} else {echo $schedClass['classPrice']; }?>"/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['classPrice'])) {
                                echo $errors['classPrice'];
                            }
                            ?>
                        </span>
                    </div><!--end td5-->
                    <div id="tr5">
                        Max Number of Students:&nbsp;&nbsp;
                        <input type="text" id="classMaxParticipants" name="classMaxParticipants" style="width: 20px" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['classMaxParticipants'], ENT_COMPAT, 'UTF-8');} else {echo $schedClass['classMaxParticipants']; }?>"/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['classMaxParticipants'])) {
                                echo $errors['classMaxParticipants'];
                            }
                            ?>
                        </span>
                    </div><!--end tr5-->
                    <div id="td5">
                        Location:&nbsp;&nbsp;
                        <select id="location" name="location" onchange="enableTextbox()">
                            <option value="<?php echo $schedClass['classLocationId']; ?>"><?php echo $schedClass['locationName']; ?></option>
                            <option value="new">--Add a new location--</option>
                            <?php
                            foreach ($allTrLocate AS $rowLocate) {
                                echo "<option value='" .$rowLocate['classLocationId'] ."'>" .$rowLocate['locationName'] ."</option>";
                            }
                            ?>
                        </select>
                    </div><!--end td5-->
                    <div id="tr1"></div><!--end tr1-->
                    <div id="tr1">Add a new location</div><!--end tr1-->
                    <div id="tr1"></div><!--end tr1-->
                    <div id="tr3">Location Name:&nbsp;&nbsp;
                        <input type="text" id="locationName" name="locationName" class="txtinput2" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['locationName'], ENT_COMPAT, 'UTF-8');}?>" disabled/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['locationName'])) {
                                echo $errors['locationName'];
                            }
                            ?>
                        </span>
                    </div><!--end tr3-->
                    <div id="tr3">&nbsp;&nbsp;&nbsp;&nbsp;Address:&nbsp;&nbsp;
                        <input type="text" id="address" name="address" class="txtinput2" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['address'], ENT_COMPAT, 'UTF-8');}?>" disabled/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['address'])) {
                                echo $errors['address'];
                            }
                            ?>
                        </span>
                    </div><!--end tr3-->
                    <div id="tr3">Address 2:&nbsp;&nbsp;
                        <input type="text" id="address2" name="address2" class="txtinput2" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['address2'], ENT_COMPAT, 'UTF-8');}?>" disabled/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['address2'])) {
                                echo $errors['address2'];
                            }
                            ?>
                        </span>
                    </div><!--end tr3-->
                    <div id="tr1">City:&nbsp;&nbsp;
                        <input type="text" id="city" name="city" class="txtinput2" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['city'], ENT_COMPAT, 'UTF-8');}?>" disabled/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['city'])) {
                                echo $errors['city'];
                            }
                            ?>
                        </span>
                    </div><!--end tr1-->
                    <div id="td1">State:&nbsp;&nbsp;
                        <select id="state" name="state" disabled>
                            <option value="">Select State</option>
                            <?php foreach ($chooseState AS $rowstate) { ?>
                                <option value="<?php echo $rowstate['state_abbr']; ?>" <?php if(isset($_POST['edit']) && $_POST['state'] == $rowstate['state_abbr']): ?> selected="selected" <?php endif ?>><?php echo $rowstate['state_abbr'] ?></option>
                            <?php } ?>
                        </select>
                    </div><!--end td1-->
                    <div id="td1">Zip:&nbsp;&nbsp;
                        <input type="text" id="zip" name="zip" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['zip'], ENT_COMPAT, 'UTF-8');}?>" disabled/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['zip'])) {
                                echo $errors['zip'];
                            }
                            ?>
                        </span>
                    </div><!--end td1-->
                    <div id="tr1">&nbsp;</div><!--end tr1-->
                    <div id="tr4"><input type="submit" id="edit" name="edit" class="btn" value="Edit Schedule"/></div><!--end tr4-->
                    <div id="td3">
                        <input type="submit" id="delete" name="delete" class="btn" value="Delete Schedule" onclick="return confirm('Are you sure you want to delete this schedule?');"/>
                    </div><!--end td3-->
                    <div id="td3">
                        <input type="button" id="cancel" name="cancel" class="btn" value="Go Back" onClick="history.go(-1);return true;"/>
                    </div><!--end td3-->
                </form>
            </div><!--end mcForm-->
            <div style="height: 30px"></div><!--spacer-->
        </div><!--end maincontent-->
    </div><!--end wrapper-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>