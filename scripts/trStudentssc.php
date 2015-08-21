<?php

    error_reporting(E_ALL);

    if (isset($_GET['classSchedId'])) {
        $classSchedId = $_GET['classSchedId'];
    }
    $schedClass = getSchClassAllInfo($dbconn, $classSchedId);//all info for class
    $students = getStudents($dbconn, $classSchedId);
    $numReg = getCountParticipants($dbconn, $classSchedId);
