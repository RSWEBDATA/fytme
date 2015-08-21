<?php

    require_once '../connectdb.php';

    $sql = "SELECT classScheduled.classSchedId AS id, classScheduled.start, classScheduled.end, class.className AS title, class.classDescription AS description, classLocations.locationName AS location
            FROM classScheduled
            LEFT JOIN class ON class.classId = classScheduled.classId
            LEFT JOIN classLocations ON classLocations.classLocationId = classScheduled.classLocationId
            ";
    $result = $dbconn->query($sql);

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }

    print json_encode($rows);