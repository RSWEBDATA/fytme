<?php

require_once '../connectdb.php';
$trId = $_POST['trId'];
$sql = "SELECT * FROM availableHours WHERE trId = '$trId'";
$result = $dbconn->query($sql);

$today = getdate(date("U")); //today's date in parts to get day of the week.
$dw = $today['wday'];
$date = date('Y-m-d'); //today's date

$mod = array();
while ($r = mysqli_fetch_assoc($result)) {
    $factor = $r['dow'] - $dw;
    $stdate = date('Y-m-d', strtotime($date . $factor ." day"));
    $endtime = date('H:i:s', strtotime($r['start'] . ' 1 hour'));

    for($i=0; $i<13; $i++) {
        $mod[] = array(
            'title' => $r['title'],
            'start' => date('Y-m-d', strtotime($stdate . $i ." week")) ."T" .$r['start'],
            'end' => date('Y-m-d', strtotime($stdate . $i ." week")) ."T" .$endtime

        );
    }
}

print json_encode($mod);