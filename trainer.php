<?php

    require_once 'connectdb.php';
    require_once 'scripts/trainersc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FytMe - Meet our Trainers</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href="css/cus.css" rel="stylesheet" type="text/css" />

</head>

<body>
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
                                    <img src="images/persondef.png" title="No Picture Available"/>
                                <?php } else { ?>
                                    <img src="<?php echo $rowTr['picture']; ?>" title=""/>
                                <?php } ?>
                            </div><!--end trPanelLeft-->
                            <div id="trPanelRight">
                                <h3>
                                    <a href="trainer.php?trId=<?php echo $rowTr['contactId']; ?>" class='reg' title='Go to Profile'><?php echo $rowTr['firstName'] . " " .$rowTr['lastName']; ?></a><br/>
                                    <?php echo $rowTr['email'] ;?>
                                </h3><br/>
                                <?php
                                if ($rowTr['cpr'] == 'yes') {
                                    echo "<div id='tr6'><img src='images/CPR-Icon.png' title='CPR Certified'/></div>";
                                }
                                if ($rowTr['ncca'] == 'yes') {
                                    echo "<div id='td6'><img src='images/certicon.png' title='NCCA Certified'/></div>";
                                }
                                if ($rowTr['grp'] == 'yes') {
                                    echo "<div id='td6'><img src='images/Group-Class-Icon.png' title='Group Classes'/></div>";
                                }
                                if ($rowTr['oto'] == 'yes') {
                                    echo "<div id='td6'><img src='images/one-on-one-icon.png' title='Personal Trainer'/></div>";
                                }
                                if ($rowTr['online'] == 'yes') {
                                    echo "<div id='td6'><img src='images/Online-icon.png' title='Online Trainer'/></div>";
                                }
                                ?>
                            </div><!--end trPanelRight-->
                            <div style="clear: both; height: 5px"></div>
                        </div><!--end trPanel-->
                    <?Php } ?>
                </div><!--end scrollAreaL-->
            </div><!--end leftContent-->
            <div id="rightContent" class="bkgndshade" >
                <div id="tr2">
                    <h1><?php echo $focus['firstName'] ." " .$focus['lastName'] ." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            if ($focus['cpr'] == 'yes') {
                                echo "<img src='images/CPR-Icon.png' class='symbolpics' title='CPR Certified'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            if ($focus['ncca'] == 'yes') {
                                echo "<img src='images/certicon.png' class='symbolpics' title='NCCA Certified'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                            if ($focus['grp'] == 'yes') {
                                echo "<img src='images/Group-Class-Icon.png' class='symbolpics' title='Group Classes'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                            if ($focus['oto'] == 'yes') {
                                echo "<img src='images/one-on-one-icon.png' class='symbolpics' title='Personal Trainer'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                            if ($focus['online'] == 'yes') {
                                echo "<img src='images/Online-icon.png' class='symbolpics' title='Online Trainer'/>";
                            }
                        } ?>
                    </h1>
                </div>
                <div style="height: 10px; clear: both"></div><!--end spacer-->
                <?php if ($focus['picture'] == NULL) { ?>
                    <img src="images/persondef.png" align="left" title="No Picture Available"/>
                <?php } else { ?>
                    <img src="<?php echo $focus['picture']; ?>" class="trpics" align="left" title="<?php echo $focus['firstName'] ." " .$focus['lastName'];  ?>" alt="<?php echo $focus['firstName'] ." " .$focus['lastName'];  ?>"/>
                    <h3 class="sizebr"><?php echo str_replace(array("\r\n", "\n"), array("<br/>", "</p><p>"), $focus['bio']); ?></h3>
                <?php } ?>

                <div id="rightBot">
                    <?php echo "<h2>" .$focus['firstName'] ."'s Classes</h2>";?> <br/>
                    <div id="trclasspanel">
                        <?php
                             foreach ($classes AS $rowSch) {
                                $datetime = strtotime($rowSch['classDateTime']);
                                $date = date('M/d/Y', $datetime);
                                $time = date('h:i a', $datetime);
                                $classSchedId = $rowSch['classSchedId'];
                                $numReg = getCountParticipants($dbconn, $rowSch['classSchedId']);
                        ?>
                             <div id="trClasspanelscontainer">
                                 <div id="tr1">Class Name:&nbsp;&nbsp;<a href="class.php?classSchedId=<?php echo $rowSch['classSchedId']; ?>&zip=<?php echo $rowSch['zip']; ?>" class="reg" title="See more" ><?php echo $rowSch['className']; ?></a></div>
                                 <div id="td1">Price:&nbsp;&nbsp;$<?php echo $rowSch['classPrice']; ?></div>
                                 <div id="td1"><a href="#" id="book" class="reg">Book it</a></div>
                                 <div id="tr1">When:&nbsp;&nbsp;<?php echo $date ." at " .$time; ?></div>
                                 <div id="td2">Where:&nbsp;&nbsp;<?php echo $rowSch['address'] .", " .$rowSch['city'] .", " .$rowSch['state'] ."  &nbsp" .$rowSch['zip']; ?></div>
                                 <div id="tr3"><?php echo str_replace(array("\r\n", "\n"), array("<br/>", "</p><p>"), $rowSch['classDescription']) ?></div>
                                 <div style="clear: both; height: 10px"></div>
                             </div><!--end trclasspanelcontainer-->
                                 <div style="clear: both"></div>
                        <?php } ?>
                    </div><!--end trclasspanel-->
                </div><!--end rightBot-->
            </div><!--end rightContent-->
            <div style="clear: both; height: 5px"></div><!--spacer-->
        </div><!--end maincontent-->
    </div><!--end wrapper-->

    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div>

</body>
</html>