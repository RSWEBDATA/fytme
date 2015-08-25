<?php

error_reporting(E_ALL);

    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    $trainer = getSingleTrainer($dbconn, $contactId);
    $trId = $trainer['trId'];
    $trWOs = gettrWOs ($dbconn, $trId);
    $tr1x1 = gettr1x1($dbconn, $contactId);