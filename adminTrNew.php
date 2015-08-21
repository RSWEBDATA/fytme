<?php

    require_once 'connectdb.php';
    require_once 'scripts/adminTrNewsc.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytness Made Easy - New Trainer Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/admin.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-1.10.1.js"></script>
    <script type="text/javascript">
        EnableSubmit = function(val)
        {
            var sbmt = document.getElementById("approve");

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
</head>

<body>

<!--    <div id="topbanner">-->
<!--        --><?php //include_once 'includes/inc.admin.banner.php' ?>
<!--    </div><!--end topbanner-->-->

    <div id="contentL">
        <div id="contentLinc"><?php include_once 'includes/inc.adminSide.php' ?></div><!--end contentLinc-->
    </div><!--end contentL-->
    <div id="contentR">
        <div id="contentRbox">
            <h2>New Trainer Applicant Information</h2>
            <div style="height: 30px"></div><!--spacer-->
            <form action="" method="post" id="apprTr" name="apprTr">
                <h2>
                    <span><strong><?php echo $trInfo['firstName'] ." " .$trInfo['lastName'] ?></strong></span><br/>
                    <?php echo $trInfo['address']; ?><br/>
                    <?php echo $trInfo['city'] .", " .$trInfo['state'] ."  " .$trInfo['zip']; ?><br/>
                    <?php echo preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $trInfo['phone']) ." &nbsp;&nbsp;&nbsp;Age: " .$trAge['age']; ?><br/>
                    <?php echo $trInfo['email'] ." &nbsp;&nbsp;&nbsp;Gender: " .$trInfo['gender']; ?><br/><br/>
                    <?php echo "Application Date: " .date('m-d-Y', strtotime($trInfo['created'])); ?><br/><br/>

                    <input type="checkbox" name="bgchk" id="bgchk" value="yes" onclick="EnableSubmit(this)" />&nbsp;&nbsp;&nbsp;The background check is completed and approved
                    <br/><br/>
                    <input type="submit" id="approve" name="approve" class="btn" value="Approve Applicant" disabled/>
                </h2>
            </form>
        </div><!--end contentRbox-->
    </div><!--end contentR-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>