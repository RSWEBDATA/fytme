<?php

    require_once 'connectdb.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytness Made Easy - Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/admin.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-1.10.1.js"></script>
</head>

<body>

    <div id="topbanner">
        <?php include_once 'includes/inc.admin.banner.php' ?>
    </div><!--end topbanner-->

    <div id="contentL">
        <div id="contentLinc"><?php include_once 'includes/inc.adminSide.php' ?></div><!--end contentLinc-->
    </div><!--end contentL-->

    <div id="contentR"></div><!--end contentR-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>