<?php

    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    if (isset($_GET['trId'])) {
        $trId = $_GET['trId'];
    }

    $trainers = getAllTrainers($dbconn);
    $focus = getTrainerAllInfo($dbconn, $trId);
    $classes = getSchClasses($dbconn, $trId);