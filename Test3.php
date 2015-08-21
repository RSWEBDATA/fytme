<?php
error_reporting(E_ALL);
require_once 'connectdb.php';


if (isset($_GET['contactId'])) {
    $contactId = $_GET['contactId'];
}
$woType = getwoSubCat($dbconn);
$contact = getSingleContact($dbconn, $contactId);
$tzip = $contact['zip'];
$ll = getZipLL($dbconn, $tzip);

$trId='16';
//Script for the workout section
if (isset($_POST['addwo'])) {
    //Delete previous choices
    $sqlDeleteWO = "DELETE FROM wotrJoin WHERE trId = '$trId'";
    $dbconn->query($sqlDeleteWO);

    //Insert new choices
    if (isset($_POST['wo'])) {
        $wo = $_POST['wo'];
        $i = 0;

        foreach ($wo AS $type=>$tvalue) {
            if (isset($_POST["level" .$tvalue])) {
                $level = $_POST["level" .$tvalue];
                foreach ($level AS $key=>$value) {

                    $sqlInsert = "INSERT INTO wotrJoin (trId, woSubCatId, level) VALUES ('$trId', '$tvalue', '$value')";
                    $dbconn->query($sqlInsert);

                }
            } else {
                $level = 'beginner';
                $sqlInsert = "INSERT INTO wotrJoin (trId, woSubCatId, level) VALUES ('$trId', '$tvalue', '$level')";
                $dbconn->query($sqlInsert);

            }
        }

        foreach ($wo AS $key => $value) {
            $i++;
            echo "Choice $i || Array Key = $key || Value = $value<br>";
        }
    }
    exit ();
}

if (isset($_POST['maps'])) {
    echo $_POST['fulladdress'];
    $gadd = ($_POST['fulladdress']);
    $gaddsep = explode(",", $gadd);
    echo "Address = " .$gaddsep[0] ."<br/>";
    echo "City = " .$gaddsep[1] ."<br/>";
    $sz = explode(" ", $gaddsep[2]);
    echo "State = " .$sz[1] ."<br/>";
    echo "Zip = " .$sz[2] ."<br/>";

    $waddress = $gaddsep[0] . "+" .$gaddsep[1] ."+" .$sz[1] ."+" .$sz[2];
    $prepAddr = str_replace(' ','+',$waddress);
    $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;
    echo $latitude .", " .$longitude;
    exit ();
}

if (isset($_POST['trydate'])) {
    $dow   = 'saturday';
    $step  = 2;
    $unit  = 'W';

    $start = new DateTime('2012-06-02');
    $end   = clone $start;

    $start->modify($dow); // Move to first occurence
    $end->add(new DateInterval('P1Y')); // Move to 1 year from start

    $interval = new DateInterval("P{$step}{$unit}");
    $period   = new DatePeriod($start, $interval, $end);

    foreach ($period as $date) {
        echo $date->format('D, d M Y'), PHP_EOL;
    }
    echo $_POST['test'];
    exit();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test 3</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <!--jquerylinks-->
    <script src="http://code.jquery.com/jquery-2.0.2.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#addExist').hide();
            $('#sel').change(function() {
                var str = "";
                str = parseInt($(this).val());
                if(str == 0) {
                    $('#addExist').hide();
                    $('#addNew').show();
                } else {
                    $('#addNew').hide();
                    $('#addExist').show();
                }
            });
        });
        
        //map script
        function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng(<?php echo $ll['latitude']; ?>, <?php echo $ll['longitude']; ?>),
                zoom: 13
            };
            var map = new google.maps.Map(document.getElementById('siteMap'),
                mapOptions);

            var input = /** @type {HTMLInputElement} */(
                document.getElementById('pac-input'));

            var types = document.getElementById('type-selector');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

            autocomplete = new google.maps.places.Autocomplete((input), {types: ['geocode']});
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setIcon(/** @type {google.maps.Icon} */({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);

                fillInAddress();
            });

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                document.getElementById('fulladdress').value = place.formatted_address;
            }

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, types) {
                var radioButton = document.getElementById(id);
                google.maps.event.addDomListener(radioButton, 'click', function() {
                    autocomplete.setTypes(types);
                });
            }

            setupClickListener('changetype-all', []);
            setupClickListener('changetype-address', ['address']);
            setupClickListener('changetype-establishment', ['establishment']);
            setupClickListener('changetype-geocode', ['geocode']);
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <!--show hide div script-->
    <script type="text/javascript">
        function showMe (it, box) {
            var vis = (box.checked) ? "block" : "none";
            document.getElementById(it).style.display = vis;
        }
        function showMe2 (it) {
            var vis = document.getElementById(it).style.display
            if (vis == "block") { document.getElementById(it).style.display = "none"; }
            else { document.getElementById(it).style.display = "block"; }
        }

    </script>


    <style type="text/css">

        #container {
            width: 80%;
            margin: 50px auto 0 auto;
        }
        .tbkgnd {
            background-color: #08c9ff;
        }



        #addNew {
            width: 80%;
            background-color: #1de131;
        }

        #addExist {
            width: 80%;
            background-color: #ff0000;
        }
        /*map css*/

        #siteMap {
            width: 100%;
            height: 400px;;
        }

        .controls {
            margin-top: 16px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        .pac-container {
            font-family: Roboto;
        }

        #type-selector {
            color: #fff;
            background-color: #4d90fe;
            padding: 5px 11px 0px 11px;
        }

        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }


    </style>

</head>

<body>
<div id="container">
    <form action="Test3.php" method="post">
        <h2 align="center">CHOOSE THE WORKOUT TYPES THAT YOU WANT TO TEACH</h2>
        <h5 align="center"><em>(Please select one or all of the difficulty levels for each workout.)</em></h5>
        <div style="height: 20px; clear: both"></div><!--spacer-->
        <table id="woType" width="80%" align="center">
            <tr>
                <th>Work Out Type</th>
                <th colspan="3">Levels</th>
            </tr>
    <?php foreach ($woType AS $row) { ?>
        <tr>
        <?php $woSubCatId = $row['woSubCatId'];
            $sqlC = "SELECT * FROM wotrJoin WHERE trId = '$trId' AND woSubCatId = '$woSubCatId'";
            $resultC = $dbconn->query($sqlC);
            $wosC = mysqli_fetch_assoc($resultC);
            if ($wosC) { ?>
                <td class="tbkgnd"><input type="checkbox" name="wo[]" checked="checked" value="<?php echo $row['woSubCatId']; ?>"/> &nbsp;&nbsp;<?php echo $row['woSubCatName']; ?></td>
           <?php } else { ?>
                <td class="tbkgnd"><input type="checkbox" name="wo[]"value="<?php echo $row['woSubCatId']; ?>"/> &nbsp;&nbsp;<?php echo $row['woSubCatName']; ?></td>
           <?php }
            $woSubCatId = $row['woSubCatId'];
            $sqlT = "SELECT * FROM wotrJoin WHERE trId = '$trId' AND woSubCatId = '$woSubCatId' AND level = 'beginner'";
            $result = $dbconn->query($sqlT);
            $wos = mysqli_fetch_assoc($result);
            if ($wos['level'] === 'beginner') { ?>
                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" checked="checked" value="beginner"/> &nbsp;&nbsp;Beginner</td>
            <?php } else { ?>
                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" value="beginner"/> &nbsp;&nbsp;Beginner</td>
           <?php }
            $woSubCatId = $row['woSubCatId'];
            $sqlI = "SELECT * FROM wotrJoin WHERE trId = '$trId' AND woSubCatId = '$woSubCatId' AND level = 'intermediate'";
            $resultI = $dbconn->query($sqlI);
            $woI = mysqli_fetch_assoc($resultI);
            if ($woI['level'] === 'intermediate') { ?>
                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" checked="checked" value="intermediate"/> &nbsp;&nbsp;Intermediate</td>
            <?php } else { ?>
                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" value="intermediate"/> &nbsp;&nbsp;Intermediate</td>
            <?php }
            $woSubCatId = $row['woSubCatId'];
            $sqlA = "SELECT * FROM wotrJoin WHERE trId = '$trId' AND woSubCatId = '$woSubCatId' AND level = 'advanced'";
            $resultA = $dbconn->query($sqlA);
            $woA = mysqli_fetch_assoc($resultA);
            if ($woA['level'] === 'advanced') { ?>
                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" checked="checked" value="advanced"/> &nbsp;&nbsp;Advanced</td>
            <?php } else { ?>
                <td><input type="checkbox" name="level<?php echo $row['woSubCatId']; ?>[]" value="advanced"/> &nbsp;&nbsp;Advanced</td>
            <?php } ?>
        </tr>
    <?php } ?>
        </table>
        <input type="submit" id="addwo" name="addwo" value="Submit"/>
    </form>


    <!--Create map that autocompletes address-->

        <div id="container">
            <select id="sel" name="sel">
                <option value="0">Add New</option>
                <option value="1">Old One</option>
                <option value="2">Another Old One</option>
            </select>
            <form action="" method="post" id="map">
                <div id="addNew">
                    <input id="pac-input" class="controls" type="text"
                           placeholder="Enter a location">
                    <div id="type-selector" class="controls">
                        <input type="radio" name="type" id="changetype-all" checked="checked">
                        <label for="changetype-all">All</label>

                        <input type="radio" name="type" id="changetype-establishment">
                        <label for="changetype-establishment">Establishments</label>

                        <input type="radio" name="type" id="changetype-address">
                        <label for="changetype-address">Addresses</label>

                        <input type="radio" name="type" id="changetype-geocode">
                        <label for="changetype-geocode">Geocodes</label>
                    </div>
                    <div id="siteMap"></div>
                    <form action="" method="post" id="map">

                    <input type="hidden" id="fulladdress" name="fulladdress"/>

                    <input type="submit" id="maps" name="maps" Value="Submit Map"/>
                </div>
            </form>
            <div id="addExist">&nbsp;</div>
        </div>

    <!--show hide example-->
    <p><input type="checkbox" onclick="showMe('div1', this)" />Click the box</p>
    <div id="div1" style="display: none">Show the text on the check.</div>

    <div id="container">
        <form action="" method="post">
            <input type="text" id="test" name="test"/>
            <input type="submit" id="trydate" name="trydate" value="Check date interval"/>
        </form>
    </div>
</body>
</html>
