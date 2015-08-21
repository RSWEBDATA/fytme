<?php
    require_once 'connectdb.php';
    require_once 'scripts/trSchGroupClasssc.php';



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytmness Made Easy - Add a Class Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <!--jquerylinks-->
    <script src="http://code.jquery.com/jquery-2.0.2.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!--Date Picker-->
    <link type="text/css" href="css/jquery.simple-dtpicker.css" rel="stylesheet" />
    <script src="js/jquery.simple-dtpicker.js"></script>
    <script type="text/javascript" src="js/trSchGroupClass.js"></script>
    <!-- Map code-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script type="text/javascript">
        //Limit textarea imput
        function limitText(limitField, limitCount, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                limitCount.value = limitNum - limitField.value.length;
            }
        }
        //show hide new location divs
        $(function() {
            $('#addExist').hide();
            $('#newLocation').change(function() {
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

        //show hide recurring div on checked
        function showMe (it, box) {
            var vis = (box.checked) ? "block" : "none";
            document.getElementById(it).style.display = vis;
        }


        //addnew map script
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

    <style type="text/css">
        body {
            background-image      : url("images/trsignup.jpg");
            background-attachment : fixed;
            background-position   : 50% 50%;     /* or: center center */
            background-repeat: no-repeat;
            background-size       : cover;
        }



    </style>
</head>

<body onload="load()">
    <div id="topbanner">
        <?php include_once 'includes/inc.trainer.banner.php' ?>
    </div><!--end topbanner-->
    <div id="tpwrap">
        <form action="" id="schClass" name="schClass" method="post">
            <div id="tpContainer">
                <h1 align="center">SCHEDULE A GROUP CLASS</h1>
                <div style="height: 20px"></div><!--spacer-->
                <h2>Class</h2><br/>
                <h3 style="margin-left: 5%"><em>Add a new class or select a previous one</em></h3>
                <div id="tr33">
                    <select id="classId" name="classId">
                        <option value="0">Add new class</option>
                        <?php
                        foreach ($allTrClasses AS $rowTRC) {
                            echo "<option value='" .$rowTRC['classId'] ."' data-classid='" .$rowTRC['classId'] ."' data-classname='" .$rowTRC['className'] ."' data-classdescription='" .$rowTRC['classDescription'] ."'
                                    data-wosubcatid='" .$rowTRC['woSubCatId'] ."' data-level='" .$rowTRC['level'] ."'>" .$rowTRC['className'] ."</option>";
                        }
                        ?>
                    </select>
                </div><!--end tr33-->
                <div id="tr33"><br/>
                    <input type="text" id="classname" name="classname" placeholder="Class Name" value="<?php if ($_POST && $errors && $_POST['classId'] == 0) {
                        echo htmlentities($_POST['classname'], ENT_COMPAT, 'UTF-8');}?>"/>
                    <h5><em>Be sure to indicate the skill level in the name</em></h5>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['classname'])) {
                            echo $errors['classname'];
                        }
                        ?>
                    </span><br/>
                </div><!--end tr33-->
<!--                <div id="td1h1"><br/>-->
<!--                    <input type="submit" id="editclass" name="editclass" class="btn" value="Edit Class"-->
<!--                           onclick="return confirm('Editing the class information will change the information for all scheduled classes associated with this particular class description.')"/>-->
<!--                </div><!--end tdi-->
                <div id="tr87">
                    <h3>Description:</h3>
                    <textarea id="classdescription" name="classdescription" class="pub" rows="10" cols="100" onkeydown="limitText(this.form.classdescription, this.form.countdown1, 250);" onkeyup="limitText(this.form.classdescription, this.form.countdown1, 250)"><?php if(isset($_POST['addSched']) && $_POST['classId'] == 0) echo $_POST['classdescription']; ?></textarea>
                    <h5>(Maximum characters: 250)<br>
                        <input readonly type="text" name="countdown1" size="3" class="count" value="250"/>characters left.</h5>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['classdescription'])) {
                            echo $errors['classdescription'];
                        }
                        ?>
                    </span><br/>
                </div><!--end tr87-->
                <div id="tr40"><br/>
                    <select name="wosubcatid">
                        <option value="">--Select a Work Out Type--</option>
                        <?php
                        foreach ($woSubCat AS $rowSC) { ?>
                            <option value="<?php echo $rowSC['woSubCatId']; ?>" <?php if(isset($_POST['addSched']) && $_POST['wosubcatid']==$rowSC['woSubCatId']): ?> selected="selected" <? endif ?>><?php echo $rowSC['woSubCatName']; ?></option>
                        <?php }
                        ?>
                    </select><br/>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['woSubCatId'])) {
                            echo $errors['woSubCatId'];
                        }
                        ?>
                    </span>
                </div><!--end tr40-->
                <div id="td40"><br/>
                    <select name="level">
                        <option value="">--Skill Level--</option>
                        <option value="beginner" <?php if(isset($_POST['addSched']) && $_POST['level'] == 'beginner'): ?> selected="selected" <?php endif ?>>Beginner</option>
                        <option value="intermediate" <?php if(isset($_POST['addSched']) && $_POST['level'] == 'intermediate'): ?> selected="selected" <?php endif ?>>Intermediate</option>
                        <option value="advanced" <?php if(isset($_POST['addSched']) && $_POST['level'] == 'advanced'): ?> selected="selected" <?php endif ?>>Advanced</option>
                    </select>
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['level'])) {
                            echo $errors['level'];
                        }
                        ?>
                    </span>
                </div><!--end td40-->
            </div><!--end tpContainer-->
            <div id="tpContainer">
                <h2>Class</h2><br/>
                <h3 style="margin-left: 5%"><em>Add a new location or select a previous one</em></h3>
                <div id="tr33">
                    <select id="newLocation" name="newLocation" onchange="locate();">
                        <option value="0">Add a Location</option>
                        <?php
                        foreach ($allTrLocate AS $rowTRL) {
                            echo "<option value='" .$rowTRL['classLocationId'] ."' data-locationname='" .$rowTRL['locationName'] ."' data-address='" .$rowTRL['address']
                                ."' data-address2='" .$rowTRL['address2'] ."' data-city='" .$rowTRL['city'] ."' data-state='" .$rowTRL['state'] ."' data-zip='" .$rowTRL['zip']
                                ."' data-latitude='" .$rowTRL['latitude'] ."' data-longitude='" .$rowTRL['longitude'] ."' >" .$rowTRL['locationName'] ."</option>";
                            $elocationId = $rowTRL['classLocationId'];
                        }
                        ?>
                    </select><br/>
                </div><!--end tr33-->
                <div id="tr33"><br/>
                    <input type="text" id="locationname" name="locationname" placeholder="Location Name" value="<?php if ($_POST && $errors && $_POST['newLocation'] == 0) {
                        echo htmlentities($_POST['locationname'], ENT_COMPAT, 'UTF-8');}?>" />
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['locationname'])) {
                            echo $errors['locationname'];
                        }
                        ?>
                    </span><h5><em>Pick an easily identifiable name</em></h5><br/>
                </div>
                <div id="addNew">
                    <span class="error">
                        <?php
                        if ($_POST && isset($errors['address'])) {
                            echo $errors['address'];
                        }
                        ?>
                    </span>
                    <input id="pac-input" class="controls" type="text"
                           placeholder="Enter a location">
                    <div id="siteMap"></div>
                    <input type="hidden" id="fulladdress" name="fulladdress"/>
                </div><!--end addNew-->
                <div id="addExist">
                    <div id="tr66">
                        <input type="text" id="address" name="address" placeholder="Address" value="<?php if ($_POST && $errors && $_POST['newLocation'] == 0) {
                            echo htmlentities($_POST['address'], ENT_COMPAT, 'UTF-8');}?>" /><br/>
                        <span class="error">
                            <?php
                            if ($_POST && isset($errors['address'])) {
                                echo $errors['address'];
                            }
                            ?>
                        </span>
                    </div><!--end tr66-->
                    <div id="tr33">
                        <input type="text" id="city" name="city" placeholder="City" value="<?php if ($_POST && $errors && $_POST['newLocation'] == 0) {
                            echo htmlentities($_POST['city'], ENT_COMPAT, 'UTF-8');}?>" /><br/>
                        <span class="error">
                            <?php
                            if ($_POST && isset($errors['city'])) {
                                echo $errors['city'];
                            }
                            ?>
                        </span>
                    </div><!--end tr33-->
                    <div id="td15" style="margin-left: 3%">
                        <select id="state" name="state">
                            <option value="">State</option>
                            <?php foreach ($chooseState AS $rowstate) { ?>
                                <option value="<?php echo $rowstate['state_abbr']; ?>" <?php if(isset($_POST['addSched']) && $_POST['newLocation'] == 0 && $_POST['state'] == $rowstate['state_abbr']): ?> selected="selected" <?php endif ?>><?php echo $rowstate['state_abbr'] ?></option>
                            <?php } ?>
                        </select>
                    </div><!--end td15-->
                    <div id="td33">
                        <input type="text" id="zip" name="zip" placeholder="Zip Code" value="<?php if ($_POST && $errors && $_POST['newLocation'] == 0) {
                            echo htmlentities($_POST['zip'], ENT_COMPAT, 'UTF-8');}?>" /><br/>
                        <span class="error">
                            <?php
                            if ($_POST && isset($errors['zip'])) {
                                echo $errors['zip'];
                            }
                            ?>
                        </span>
                    </div><!--end td33-->
<!--                    <div id="td1h2">-->
<!--                        <input type="submit" id="editlocation" name="editlocation" class="btn" value="Edit Location"-->
<!--                               onclick="return confirm('Editing the location will change the information for all scheduled classes associated with this particular location.')" />-->
<!--                    </div><!--end td1h2-->
                </div><!--end addExist-->
            </div><!--end tpContainer-->
            <div id="tpContainer">
                <h2>Schedule Specifics</h2><br/>
                <div id="tr40">
                    <h3><em>Pick a date and time</em></h3>
                    <input type="text" id="dateTime" name="dateTime" placeholder="Pick a start date and time" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['dateTime'], ENT_COMPAT, 'UTF-8');}?>" class="txtinput" />
                    <script type="text/javascript">
                        $(function(){
                            $('#dateTime').appendDtpicker({
                                "minuteInterval": 30,
                                "autodateOnStart": false,
                                "closeOnSelected": true,
                                "futureOnly": true
                            });
                        });
                    </script>
                    <span class="error">
                            <?php
                            if ($_POST && isset($errors['dateTime'])) {
                                echo $errors['dateTime'];
                            }
                            ?>
                        </span><br/>
                </div><!--end tr40-->
                <div id="td40"><br/>
                    <h3>Recurring: <input type="checkbox" name="isRecur" onclick="showMe('clRecur', this)" value="yes"/></h3>
                </div><!--end tr33-->
                <div id="clRecur">
                    <h3>If yes, at what interval:</h3>
                    <ul>
                        <li><input type="radio" name="recur" class="rad disable" value="D"/>Daily</li>
                        <li><input type="radio" name="recur" class="rad disable" value="W"/>Weekly</li>
                        <li><input type="radio" name="recur" class="rad disable" value="M"/>Monthly</li>
                        <li><input type="radio" name="recur" class="rad disable" value="0"/>Or choose the days of the week</li>
                    </ul><br/>
                    <ul>
                        <li><input type="checkbox" id="day[]" name="dayVar[]" class="dp" value="sunday"/>&nbsp;Sunday</li>
                        <li><input type="checkbox" id="day[]" name="dayVar[]" class="dp" value="monday"/>&nbsp;Monday</li>
                        <li><input type="checkbox" id="day[]" name="dayVar[]" class="dp" value="tuesday"/>&nbsp;Tuesday</li>
                        <li><input type="checkbox" id="day[]" name="dayVar[]" class="dp" value="wednesday"/>&nbsp;Wednesday</li>
                        <li><input type="checkbox" id="day[]" name="dayVar[]" class="dp" value="thursday"/>&nbsp;Thursday</li>
                        <li><input type="checkbox" id="day[]" name="dayVar[]" class="dp" value="friday"/>&nbsp;Friday</li>
                        <li><input type="checkbox" id="day[]" name="dayVar[]" class="dp" value="saturday"/>&nbsp;Saturday</li>
                    </ul><br/>
                    <h3>How far into the future do you want this schedule</h3>
                    <ul>
                        <li><input type="radio" name="futint" class="rad" checked="checked" value="P3M"/>3 months</li>
                        <li><input type="radio" name="futint" class="rad" value="P6M"/>6 months</li>
                        <li><input type="radio" name="futint" class="rad" value="P1Y"/>1 year</li>
                    </ul>
                    <h5><em>Three months is the default</em></h5><br>
                </div><!--end recur-->
                <div id="tr40">
                    <input type="text" id="classPrice" name="classPrice" class="currency" placeholder="Set a price" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['classPrice'], ENT_COMPAT, 'UTF-8');}?>" />
                        <span class="error">
                            <?php
                            if ($_POST && isset($errors['classPrice'])) {
                                echo $errors['classPrice'] ."<br/>";
                            }
                            ?>
                        </span><br/>
                </div><!--end tr40-->
                <div id="td40">
                    <input type="text" id="classMaxParticipants" name="classMaxParticipants" placeholder="Max No. of Students" value="<?php if ($_POST && $errors) {
                        echo htmlentities($_POST['classMaxParticipants'], ENT_COMPAT, 'UTF-8');}?>" />
                        <span class="error">
                            <?php
                            if ($_POST && isset($errors['classMaxParticipants'])) {
                                echo $errors['classMaxParticipants'] ."<br/>";
                            }
                            ?>
                        </span><br/>
                </div><!--end td40-->
                <div style="height: 20px"></div><!--spacer-->
                <div id="tr95"><input type="submit" id="addSched" name="addSched" class="btn" value="Add Schedule"/></div><!--end tr95-->
            </div><!--end tpContainer-->
            <div style="height: 80px"></div><!--spacer-->
        </form><!--end form schClass-->
    </div><!--end tpwrap-->
    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>