<?php

    require_once 'connectdb.php';
    require_once 'scripts/trAddClass1x1sc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytmness Made Easy - Add Class</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-2.0.2.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script type="text/javascript" src="js/trAddClass1x1.js"></script>
    <script language="javascript" type="text/javascript">
        //Limit textarea imput
        function limitText(limitField, limitCount, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                limitCount.value = limitNum - limitField.value.length;
            }
        }
        //currency check
        $(".currency").onchanged(function() {
            var valid = /^\d{0,4}(\.\d{0,2})?$/.test(this.value)
            if(!valid) {
                alert("Please enter your price in number format.");
            }
        });
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
<!--    <div id="topbanner">-->
<!--        --><?php //include_once 'includes/inc.trainer.banner.php' ?>
<!--    </div><!--end topbanner-->-->
    <div id="tpwrap">
        <div id="tpContainer">
            <h2 align="center">Please create a class for each of your selected work out types.</h2>
            <h3 align="center"><em>These classes will be for one on one training sessions.</em></h3>
            <span class="error">
                <?php
                if ($_POST && isset($errors['classDescription'])) {
                    echo $errors['classDescription'];
                }
                ?>
            </span>
        </div><!--end tpContainer-->
        <form action="" method="post" name="addClass">
            <?php
                foreach ($needed as $rowN) { ?>
                    <div id="tpContainer">
                        <div id="tr40"><input type="text" name="woSubCatName[]" value="<?php echo $rowN['woSubCatName'] ?>" disabled/>
                            <input type="hidden" name="woSubCatId[]" value="<?php echo $rowN['woSubCatId'] ?>"/></div><!--end tr40-->
                        <div id="td40"><input type="text" name="level[]" value="<?php echo $rowN['level'] ?>" readonly /></div><!--end td40-->

                        <div id="tr87"><br/>
                            Class Description:<br/><textarea name="classDescription[]" required class="pub" rows="5" cols="80" maxlength="250"></textarea>
                        </div><!--end tr87-->
                        <div id="tr33"><br/>
                            <input type="text" name="price1x1[]" pattern="[0-9][0-9].[0-9][0-9]" title="Please enter the price in x.xx format (e.g. 3.99)" class="currency" placeholder="Set price for 1x1 training"/>
                        </div><!--end tr33-->
                        <div style="height: 30px;"></div><!--spacer-->
                    </div><!--end tpContainer-->
            <?php } ?>
            <div style="height: 30px;"></div><!--spacer-->
            <div id="tpContainer">
               <input type="submit" id="addClass" name="addClass" class="btn" value="Add Classes"/>
            </div><!--end tpContainer-->
        </form>
        <div style="height: 80px;"></div><!--spacer-->
    </div><!--end tpwrap-->
    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>
