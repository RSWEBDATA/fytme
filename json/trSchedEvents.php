<?php

    require_once '../connectdb.php';

    $sql = "SELECT classScheduled.classSchedId AS id, classScheduled.start, classScheduled.end, woSubCat.woSubCatName AS title, class.classDescription AS description, classLocations.locationName AS location
            FROM classScheduled
            LEFT JOIN class ON class.classId = classScheduled.classId
            LEFT JOIN classLocations ON classLocations.classLocationId = classScheduled.classLocationId
            LEFT JOIN woSubCat ON woSubCat.woSubCatId = class.woSubCatId";
    $result = $dbconn->query($sql);

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }

    print json_encode($rows);