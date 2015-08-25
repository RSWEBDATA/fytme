<?php

//Connect to Database

$hostName = "localhost";
$userName = "fytmeuser";
$password = "20WeTrain02";
$dbname = "fytmedb";

$dbconn = mysqli_connect($hostName, $userName, $password, $dbname)
or die("unable to connect");

//if (mysqli_ping($dbconn)) {
//    echo 'mysql server' . mysqli_get_server_info($dbconn) . ' on ' . mysqli_get_host_info($dbconn);
//}

//SQL Statements

//Search ALL States
function getAllState ($dbconn) {
    $sqlgetAllState = "SELECT * FROM state";
    $resultGetAllStates = $dbconn->query($sqlgetAllState);
    return $resultGetAllStates;
}

//Get single contact
function getSingleContact ($dbconn, $contactId) {
    $sqlgetSC = "SELECT * FROM contacts WHERE contactId = $contactId";
    $resultgetSC = $dbconn->query($sqlgetSC);
    $gSC = mysqli_fetch_assoc($resultgetSC);
    return $gSC;
}

//Get single trainer info
function getSingleTrainer ($dbconn, $contactId) {
    $sqlgetST = "SELECT * FROM trainers WHERE contactId = '$contactId'";
    $resultgetST = $dbconn->query($sqlgetST);
    $gST = mysqli_fetch_assoc($resultgetST);
    return $gST;
}

//Get single trainer all info
function getTrainerAllInfo ($dbconn, $contactId) {
    $sqlTAI = "SELECT * FROM trainers LEFT JOIN contacts ON contacts.contactId = trainers.contactId WHERE trainers.contactId = $contactId";
    $resultTAI = $dbconn->query($sqlTAI);
    $TAI = mysqli_fetch_assoc($resultTAI);
    return $TAI;
}

//Get all trainers info
function getAllTrainers ($dbconn) {
    $sqlgAllTrainers = "SELECT * FROM trainers
                        LEFT JOIN contacts ON contacts.contactId=trainers.contactId
                        WHERE trainers.active='active'";
    $resultAT = $dbconn->query($sqlgAllTrainers);
    return $resultAT;
}

//Get all major categories
function getMajorCategories ($dbconn) {
    $sqlMajCat = "SELECT * FROM majorClassCategories";
    $resultMajCat = $dbconn->query($sqlMajCat);
    return $resultMajCat;
}

//Get trainer selected work outs (Those the trainer wants to train)
function gettrWOs ($dbconn, $trId) {
    $sqlTrWOs = "SELECT wotrJoin.*, woSubCat.woSubCatName FROM wotrJoin
                 LEFT JOIN woSubCat ON woSubCat.woSubCatId=wotrJoin.woSubCatId WHERE trId=$trId";
    $resultTrWOs = $dbconn->query($sqlTrWOs);
    return $resultTrWOs;
}

//Get all classes by trainer
function getAllTrClasses ($dbconn, $contactId) {
    $sqlAllTrClass = "SELECT class.*, woSubCat.woSubCatName FROM class LEFT JOIN woSubCat ON woSubCat.woSubCatId = class.woSubCatId WHERE contactId=$contactId AND active='active'";
    $resultATC = $dbconn->query($sqlAllTrClass);
    return $resultATC;
}

//Get all 1x1 classes by trainer
function gettr1x1 ($dbconn, $contactId) {
    $sqltr1x1 = "SELECT class.*, woSubCat.woSubCatName FROM class LEFT JOIN woSubCat ON woSubCat.woSubCatId = class.woSubCatId WHERE contactId=$contactId AND price1x1 IS NOT NULL";
    $resulttr1x1 = $dbconn->query($sqltr1x1);
    return $resulttr1x1;
}

//Get all 1x1 workouts that do not have classes yet
function getClassesNeeded ($dbconn, $contactId, $trId) {
    $sqlGCN = "SELECT wotrJoin.*, t.*, woSubCat.woSubCatName FROM wotrJoin
               LEFT JOIN woSubCat ON woSubCat.woSubCatId=wotrJoin.woSubCatId
               LEFT JOIN
               (SELECT class.classId, class.woSubCatId AS ident FROM class WHERE contactId = $contactId) t ON t.ident = wotrJoin.woSubCatId
               WHERE trId=$trId AND t.classId IS NULL";
    $resultCGN = $dbconn->query($sqlGCN);
    return $resultCGN;
}

//Get all locations by trainer
function getAllTrLocations ($dbconn, $contactId) {
    $sqlAllTrLocations = "SELECT * FROM classLocations WHERE contactId=$contactId AND active='active'";
    $resultATL = $dbconn->query($sqlAllTrLocations);
    return $resultATL;
}

//Get all scheduled classes by trainer
function getSchClasses ($dbconn, $contactId) {
    $sqlSchClass = "SELECT * FROM classScheduled AS cs
                    Left JOIN contacts ON contacts.contactId=cs.contactId
                    LEFT JOIN class ON class.classId=cs.classId
                    LEFT JOIN classLocations AS cl ON cl.classLocationId=cs.classLocationId
                    WHERE cs.contactId=$contactId AND cs.classDateTime >= CURRENT_DATE()
                    ORDER BY cs.classDateTime ASC ";
    $resultSchClass = $dbconn->query($sqlSchClass);
    return $resultSchClass;
}

//Count participants registered per scheduled class
function getCountParticipants ($dbconn, $classSchedId) {
    $sqlCount = "SELECT COUNT(*) as total FROM classParticipants WHERE classSchedId=$classSchedId";
    $resultCount = $dbconn->query($sqlCount);
    $cp = mysqli_fetch_assoc($resultCount);
    return $cp;
}

//Get Specific Scheduled Class
function getSchedClass ($dbconn, $classSchedId) {
    $sqlSchClass = "SELECT * FROM classScheduled WHERE classSchedId=$classSchedId";
    $resultSchClass = $dbconn->query($sqlSchClass);
    $schClass = mysqli_fetch_assoc($resultSchClass);
    return $schClass;
}

//Get Specific Class
function getClass ($dbconn, $classId) {
    $sqlGetClass = "SELECT * FROM class WHERE classId=$classId";
    $resultGetClass = $dbconn->query($sqlGetClass);
    $class = mysqli_fetch_assoc($resultGetClass);
    return $class;
}

//Get Specific Subclass Category
function getSingleSubCat ($dbconn, $subClassCatId) {
    $sqlgetSubCat = "SELECT * FROM subClassCategories WHERE subClassCatId=$subClassCatId";
    $resultSubCat = $dbconn->query($sqlgetSubCat);
    $subcat = mysqli_fetch_assoc($resultSubCat);
    return $subcat;
}

//Get Specific Location
function getLocation ($dbconn, $classLocationId) {
    $sqlgetLocation = "SELECT * FROM classLocations WHERE classLocationId = $classLocationId";
    $resultGLoc = $dbconn->query($sqlgetLocation);
    $GLoc = mysqli_fetch_assoc($resultGLoc);
    return $GLoc;
}

//Get specific schedule class with all joins
function getSchClassAllInfo ($dbconn, $classSchedId) {
    $sqlgSCAI = "SELECT csd.*, class.className, class.subClassCatId, class.classDescription, cl.locationName, cl.address, cl.address2, cl.city, cl.state, cl.zip, cl.latitude, cl.longitude
                FROM classScheduled AS csd
                LEFT JOIN class ON class.classId = csd.classId
                LEFT JOIN classLocations AS cl ON cl.classLocationId = csd.classLocationId
                WHERE csd.classSchedId = $classSchedId";
    $resultsqlSCAI = $dbconn->query($sqlgSCAI);
    $SCAI = mysqli_fetch_assoc($resultsqlSCAI);
    return $SCAI;
}

//Get all scheduled classes with all joins.
function getAllSchClass ($dbconn) {
    $sqlallSchClass = "SELECT csd.*, class.className, class.subClassCatId, class.classDescription,
                      cl.locationName, cl.address, cl.address2, cl.city, cl.state, cl.zip, cl.latitude, cl.longitude, contacts.contactId AS trId, contacts.firstName, contacts.lastName
                      FROM classScheduled AS csd
                      LEFT JOIN class ON class.classId = csd.classId
                      LEFT JOIN classLocations AS cl ON cl.classLocationId = csd.classLocationId
	                  LEFT JOIN contacts ON contacts.contactId = csd.contactId";
    $resultallSchClass = $dbconn->query($sqlallSchClass);
    return $resultallSchClass;
}

//Get Class Participants
function getStudents ($dbconn, $classSchedId) {
    $sqlgetStudents = "SELECT * FROM classParticipants
                       LEFT JOIN contacts ON contacts.contactId = classParticipants.contactId
                       WHERE classSchedId = $classSchedId";
    $resultStudents = $dbconn->query($sqlgetStudents);
    return $resultStudents;
}

//Get Age
function getAge($birthday){
    return floor((time() - strtotime($birthday))/31556926);
}

function getAge2 ($dbconn, $trTempId) {
    $sqlAge ="SELECT DATE_FORMAT(now(), '%Y') - Date_Format(birthDate, '%Y') - (DATE_FORMAT(now(), '00-%m-%d') < DATE_FORMAT(birthDate, '00-%m-%d')) AS age
              FROM trTemp WHERE trTempId=$trTempId";
    $resultAge = $dbconn->query($sqlAge);
    $age = mysqli_fetch_assoc($resultAge);
    return $age;
}

//get ZipLatLong
function getZipLL ($dbconn, $tzip) {
    $sqlZipll = "SELECT * FROM ziplatlong WHERE zip = $tzip";
    $resultZipll = $dbconn->query($sqlZipll);
    $zipll = mysqli_fetch_assoc($resultZipll);
    return $zipll;
}

//Get all scheduled classes for specific participant
function getParticipantClasses ($dbconn, $contactId) {
    $sqlPC = "SELECT cp.*, csd.*, class.className, class.contactId AS trId, cl.address, cl.city, cl.state, cl.zip
                FROM classParticipants AS cp
                LEFT JOIN classScheduled AS csd ON csd.classSchedId=cp.classSchedID
                LEFT JOIN class ON class.classId = csd.classId
                LEFT JOIN classLocations AS cl ON cl.classLocationId = csd.classLocationId
                WHERE csd.classDateTime >= CURRENT_DATE() AND cp.contactId = $contactId";
    $resultPC = $dbconn->query($sqlPC);
    return $resultPC;
}

//Get howFound list
function gethowFound ($dbconn) {
    $sqlHF = "SELECT * FROM howFound";
    $resultHF = $dbconn->query($sqlHF);
    return $resultHF;
}

//Get new trainer list
function getNewTr ($dbconn) {
    $sqlNT = "SELECT trTempId, firstName, lastName FROM trTemp ORDER BY lastName";
    $resultNT = $dbconn->query($sqlNT);
    return $resultNT;
}

//Get Specific New Trainer info
function getSpNewTr ($dbconn, $trTempId) {
    $sqlSNT = "SELECT * FROM trTemp WHERE trTempId = $trTempId";
    $resultSNT = $dbconn->query($sqlSNT);
    $SNT = mysqli_fetch_assoc($resultSNT);
    return $SNT;
}

//Get specific contact
function getContact ($dbconn, $contactId) {
    $sqlCon = "SELECT * FROM contacts";
    $resultCon = $dbconn->query($sqlCon);
    $Con = mysqli_fetch_assoc($resultCon);
    return $Con;
}

//Check access table for duplicate email entry and for password reset page
function checkEmailDup ($dbconn, $temail) {
    $sqlCheck = "SELECT * FROM access WHERE email='$temail'";
    $resultCheck = $dbconn->query($sqlCheck);
    return $resultCheck;
}

//Check to see if reset code still valid
function checkResetCode ($dbconn, $code) {
    $sqlCheckC = "SELECT * FROM pwdReset WHERE code = '$code'";
    $result = $dbconn->query($sqlCheckC);
    $check = mysqli_fetch_assoc($result);
    return $check;
}

//Get work out types
function getwoSubCat ($dbconn) {
    $sqlWOT = "SELECT * FROM woSubCat ORDER BY woSubCatName ASC";
    $resultWOT = $dbconn->query($sqlWOT);
    return $resultWOT;
}

//Get travel radius
function getRadius ($dbconn) {
    $sqlRad = "SELECT * FROM radius";
    $resultRad = $dbconn->query($sqlRad);
    return $resultRad;
}
