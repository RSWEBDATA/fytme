<?php
error_reporting(E_ALL);
    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    if (isset($_GET['classSchedId'])) {
        $classSchedId = $_GET['classSchedId'];
    }

    $trainers = getAllTrainers($dbconn);
    $schClass = getSchClassAllInfo ($dbconn, $classSchedId);

    if (isset($_GET['zip'])) {
        $zip = $_GET['zip'];
    }

    $ll = getZipLL ($dbconn, $zip);