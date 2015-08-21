<?php

    require_once 'connectdb.php';
    require_once 'scripts/trEditClasssc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytness Made Easy - Trainer Edit Class</title>
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
    <style type="text/css">
        body {
            background-image: none;
            background-color: #000000;
        }
    </style>

</head>

<body>
    <div id="topbanner">
        <?php include_once 'includes/inc.trainer.banner.php' ?>
    </div><!--end topbanner-->

    <div id="wrapper">
        <div id="maincontent">
            <div style="height: 50px"></div><!--spacer-->
            <h1>Edt the class named "<?php echo $class['className']; ?>"</h1>
            <h2>Editing this class will change all of the scheduled classes associated with this class name and description.</h2>
            <div style="height: 20px"></div><!--spacer-->

            <div id="mcForm">
                <form action="" method="post" name="editClass">
                    <div id="tr1">
                        Class Name: <br/><input type="text" id="className" name="className" class="txtinput" value="<?php if ($_POST && $errors) {
                            echo htmlentities($_POST['className'], ENT_COMPAT, 'UTF-8');} else { echo $class['className']; }?> "/><br/>
                        <span class="error">
                            <?php
                            if ($_POST && isset($errors['className'])) {
                                echo $errors['className'];
                            }
                            ?>
                        </span>
                    </div><!--end tr1-->
                    <div id="tr2">
                        Class Description:<br/><textarea id="classDescription" name="classDescription" rows="10" cols="80"><?php if ($_POST && $errors) {
                                echo htmlentities($_POST['classDescription'], ENT_COMPAT, 'UTF-8');} else { echo $class['classDescription'];} ?></textarea>
                    </div><!--end tr2-->
                    <div id="tr1">
                        <select id="subClassCatId" name="subClassCatId">
                            <option selected="selected" value="<?php echo $getSpecSubCat['subClassCatId']; ?>"><?php echo $getSpecSubCat['subClassCategory'] ?></option>
                            <?php
                            foreach ($subCat AS $rowSC) {
                                echo "<option value='" .$rowSC['subClassCatId'] ."' >" .$rowSC['subClassCategory'] ."</option>";
                            }
                            ?>
                        </select>
                    </div><!--end tr1-->
                    <div id="tr3">&nbsp;</div><!--end tr3-->
                    <div id="tr2">
                        <input type="submit" id="editClass" name="editClass" class="btn" value="Edit Class"/>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="delClass" name="delClass" class="btn" value="Delete Class"/>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="cancel" name="cancel" class="btn" value="Go Back"/>
                </form><!--end form-->
                <div style="height: 50px"></div><!--spacer-->
            </div><!--end mcForm-->
            <div style="height: 50px"></div><!--spacer-->
        </div><!--end maincontent-->
    </div><!--end wrapper-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>