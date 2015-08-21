<?php
error_reporting(E_ALL);
require_once 'connectdb.php';
$address = '158 Roadrunner Ave';
$city = 'New Braunfels';
$state = 'TX';
$zip = '78130';
$waddress = $address . " " .$city ." " .$state ." " .$zip;
$prepAddr = str_replace(' ','+',$waddress);
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
$output= json_decode($geocode);
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;

$locations = getAllSchClass($dbconn);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type='text/javascript' src='http://code.jquery.com/jquery-2.0.2.js'></script>
    <link href="css/main.css" rel="stylesheet" type="text/css" />

    <style type="text/css">

        
    </style>

</head>

<body>
    <?php echo $latitude; ?><br/>
    <?php echo $longitude; ?>

    <?php
    while ($r = mysqli_fetch_assoc($locations)) {
        $rows[] = $r;
    }
    $output = json_encode($rows);

    echo $output;
    ?>

</body>

</html>