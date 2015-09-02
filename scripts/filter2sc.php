<?php

    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    if (isset($_GET['woMajorId'])) {
        $woMajorId = $_GET['woMajorId'];
    }

    if (isset($_GET['classType'])) {
        $classType = $_GET['classType'];
    }


    $wo = getWobyMajCat ($dbconn, $woMajorId);



