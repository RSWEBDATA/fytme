<?php
    require_once 'connectdb.php';
    require_once 'scripts/trEditLocationsc.php';


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytness Made Easy - Trainer Edit Location</title>
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

</head>

<body>
    <div id="topbanner">
        <?php include_once 'includes/inc.trainer.banner.php' ?>
    </div><!--end topbanner-->

    <div id="wrapper">
        <div id="maincontent">
            <div style="height: 45px"></div><!--spacer-->
            <div id="mcForm">
                <h2>Edit the location</h2>
                <form action="" id="editlocate" name="editlocate" method="post">
                    <div id="tr2">
                        Name:&nbsp;&nbsp;
                        <input type="text" id="locationName" name="locationName" class="txtinput2" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['locationName'], ENT_COMPAT, 'UTF-8');} else {echo $location['locationName']; }?>"/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['locationName'])) {
                                echo $errors['locationName'];
                            }
                            ?>
                        </span>
                    </div><!--tr2-->
                    <div id="tr2">
                        &nbsp;&nbsp;&nbsp;Address:&nbsp;&nbsp;
                        <input type="text" id="address" name="address" class="txtinput2" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['address'], ENT_COMPAT, 'UTF-8');} else {echo $location['address']; }?>"/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['address'])) {
                                echo $errors['address'];
                            }
                            ?>
                        </span>
                    </div><!--tr2-->
                    <div id="tr2">
                        Address2:&nbsp;&nbsp;
                        <input type="text" id="address2" name="address2" class="txtinput2" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['address2'], ENT_COMPAT, 'UTF-8');} else {echo $location['address2']; }?>"/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['address2'])) {
                                echo $errors['address2'];
                            }
                            ?>
                        </span>
                    </div>
                    <div id="tr1">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City:&nbsp;&nbsp;
                        <input type="text" id="city" name="city" class="txtinput2" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['city'], ENT_COMPAT, 'UTF-8');} else {echo $location['city']; }?>"/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['city'])) {
                                echo $errors['city'];
                            }
                            ?>
                        </span>
                    </div><!--tr1-->
                    <div id="td3">
                        State:&nbsp;&nbsp;
                        <select id="state" name="state">
                            <option selected="selected" value="<?php echo $location['state'] ?>"><?php echo $location['state'] ?></option>
                            <?php foreach ($chooseState AS $rowstate) { ?>
                                <option value="<?php echo $rowstate['state_abbr']; ?>" <?php if(isset($_POST['edit']) && $_POST['state'] == $rowstate['state_abbr']): ?> selected="selected" <?php endif ?>><?php echo $rowstate['state_abbr'] ?></option>
                            <?php } ?>
                        </select>
                    </div><!--td1-->
                    <div id="td3">
                        Zip:&nbsp;&nbsp;
                        <input type="text" id="zip" name="zip" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['zip'], ENT_COMPAT, 'UTF-8');} else {echo $location['zip']; }?>"/>
                        <span class="error"><br/>
                            <?php
                            if ($_POST && isset($errors['zip'])) {
                                echo $errors['zip'];
                            }
                            ?>
                        </span>
                    </div>
                    <div id="tr3">&nbsp;</div><!--tr3-->
                    <div id="tr4">
                        <input type="submit" id="edit" name="edit" class="btn" value="Edit Location"/>
                    </div><!--tr4-->
                    <div id="td3">
                        <input type="submit" id="inactivate" name="inactivate" class="btn" value="Delete Location"
                               onclick="return confirm('Are you sure you want to delete this location? It will still be attached to current and previous scheduled classes but will not be available for future classes. ');"/>
                    </div><!--td3-->
                    <div id="td3">
                        <input type="button" id="cancel" name="cancel" class="btn" value="Go Back" onClick="history.go(-1);return true;"/>
                    </div><!--end td3-->
                </form><!--end form-->
            </div><!--end mcForm-->
        </div><!--end maincontent-->
    </div><!--end wrapper-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>