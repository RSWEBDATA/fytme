<?php
error_reporting(E_ALL);

    require_once 'connectdb.php';
    require_once 'scripts/filter2sc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FytMe Choose a session</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Petit+Formal+Script' rel='stylesheet' type='text/css'>
    <link href="css/cus.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        body {
            background: url("images/cusBkgnd.jpg") no-repeat fixed 50% 50%;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div id="topbanner">
        <?php include_once 'includes/inc.customer.banner.php' ?>
    </div><!--end topbanner-->

    <div id="wrapper">
        <div id="container1">
            <form action="" id="filt2" method="post">
                <h2>For whom are you booking this session<br/><br/>
                    <input type="radio" id="guest" name="guest" class="rad" checked value="guest">&nbsp;&nbsp;Guest
                    <input type="radio" id="guest" name="guest" class="rad" value="myself">&nbsp;&nbsp;Myself<br/>

                    <p>
                        Please choose a work out<br><br/>
                        <select name="woSubCatId">
                            <option value="">Select</option>
                            <?php foreach ($wo as $row ) {
                                echo "<option value='" .$row['woSubCatId'] ."'>" .$row['woSubCatName'] ."</option>";
                            } ?>
                        </select>
                        <span class="error">
                            <?php
                            if ($_POST && isset($errors['woSubCatId'])) {
                                echo $errors['woSubCatId'];
                            }
                            ?>
                        </span><br/>
                    </p>
                </h2>
                <input type="submit" id="filt2sub" name="filt2sub" class="btn" value="NEXT"/>
            </form>
        </div>
    </div>

    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>
