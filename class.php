<?php

require_once 'connectdb.php';
require_once 'scripts/classsc.php';
$datetime = strtotime($schClass['classDateTime']);
$date = date('M/d/Y', $datetime);
$time = date('h:i a', $datetime);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FytMe - Class</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href="css/cus.css" rel="stylesheet" type="text/css" />
    <!-- Map code-->
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        var point;
        var mrktx;
        function load() {
            addTo = 0;
            var mapCenter = new google.maps.LatLng(<?php echo $ll['latitude'] ?>,<?php echo $ll['longitude'] ?>);
            var mapOptions = {
                center: mapCenter,
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zIndex: -1
            };

            var map = new google.maps.Map(document.getElementById('siteMap'), mapOptions);

            var position = new google.maps.LatLng(<?php echo $schClass['latitude']; ?>, <?php echo $schClass['longitude']; ?>);
            var information = "<?php echo $schClass['className'] ."<br/>"
                    .$schClass['address'] ."<br/>"
                    .$date ." at " .$time
                    .$schClass['city'] .", " .$schClass['state'] ." &nbsp;" .$schClass['zip']; ?>";
            var infowindow = new google.maps.InfoWindow({
                content: information
            });
            var marker = new google.maps.Marker({
                position: position,
                map: map
                });
            google.maps.event.addListener(marker, 'mouseover', function() {
                infowindow.open(map, marker);
            })
        }
    </script>


</head>

<body onload="load()">
<div id="topbanner">
    <?php include_once 'includes/inc.customer.banner.php'; ?>
</div><!--end topbanner-->

<div id="wrapper">
    <div id="spacetop" style="height: 20px">&nbsp;</div><!--end spacetop-->
    <div id="maincontent">
        <div id="leftContent">
            <h2>Meet Our Trainers</h2><br/>
            <div id="scrollAreaL">
                <?php foreach ($trainers AS $rowTr) { ?>
                    <div id="trPanel">
                        <div id="trPanelLeft">
                            <?php if ($rowTr['picture'] == NULL) { ?>
                                <img src="images/persondef.png" alt="No Picture Available"/>
                            <?php } else { ?>
                                <img src="<?php echo $rowTr['picture']; ?>" alt=""/>
                            <?php } ?>
                        </div><!--end trPanelLeft-->
                        <div id="trPanelRight">
                            <h3>
                                <a href="trainer.php?trId=<?php echo $rowTr['contactId']; ?>" class='reg' title='Go to Profile'><?php echo $rowTr['firstName'] . " " .$rowTr['lastName']; ?></a><br/>
                                <?php echo $rowTr['email'] ;?>
                            </h3><br/>
                            <?
                            if ($rowTr['cpr'] == 'yes') {
                                echo "<div id='tr6'><img src='images/CPR-Icon.png' alt='CPR Certified'/></div>";
                            }
                            if ($rowTr['ncca'] == 'yes') {
                                echo "<div id='td6'><img src='images/certicon.png' alt='NCCA Certified'/></div>";
                            }
                            if ($rowTr['grp'] == 'yes') {
                                echo "<div id='td6'><img src='images/Group-Class-Icon.png' alt='Group Classes'/></div>";
                            }
                            if ($rowTr['oto'] == 'yes') {
                                echo "<div id='td6'><img src='images/one-on-one-icon.png' alt='Personal Trainer'/></div>";
                            }
                            if ($rowTr['online'] == 'yes') {
                                echo "<div id='td6'><img src='images/Online-icon.png' alt='Online Trainer'/></div>";
                            }
                            ?>
                        </div><!--end trPanelRight-->
                        <div style="clear: both; height: 5px"></div>
                    </div><!--end trPanel-->
                <?Php } ?>
            </div><!--end scrollAreaL-->
        </div><!--end leftContent-->
        <div id="rightContent" class="bkgndshade" >
            <h1>Class Information</h1><br>
            <?php echo "<h2>Class Name: &nbsp;" .$schClass['className'] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='#' class='reg'>Book it</a></h2>"; ?><br/>
            <?php echo "<h2>When: &nbsp" .$date ." at " .$time ."</h2>"; ?>
            <?php echo "<h2>Where: &nbsp;" .$schClass['address'] .", " .$schClass['city'] .", " .$schClass['state'] ." &nbsp" .$schClass['zip'] ."<h2>"; ?>
            <p>
                <?php echo $schClass['classDescription']; ?>
            </p>

            <div id="siteMap"></div>

        </div><!--end rightContent-->
        <div style="clear: both; height: 5px"></div><!--spacer-->
    </div><!--end maincontent-->
</div><!--end wrapper-->

<div id="botbanner">
    <?php include_once 'includes/inc.botbanner.php'; ?>
</div>

</body>
</html>