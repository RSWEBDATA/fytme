<?php
error_reporting(E_ALL);
    session_start();
    require_once 'connectdb.php';
    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }

    $trainer = getSingleTrainer($dbconn, $contactId);
    $trId = $trainer['trId'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytmness Made Easy - Trainer Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/fullcalendar.css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

    <!--calendar js -->
    <script type="text/javascript" src="js/fullcalendar/jquery.min.js"></script>
    <script type="text/javascript" src="js/fullcalendar/moment.min.js"></script>
    <script type="text/javascript" src="js/fullcalendar/fullcalendar.js"></script>
    <script type="text/javascript" src="js/fullcalendar/EventManager.js"></script>
    <!--for modal-->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

    <script type="text/javascript">
        $(document).ready(function() {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var calendar = $('#trdcalendar').fullCalendar({
                //configure options for the calendar
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'agendaWeek',
                minTime: "06:00:00",
                maxTime: "22:00:00",
                allDaySlot: false,
                selectable: true,
                selectHelper: true,
                editable: true,
                // this is where you specify where to pull the events from.
                eventSources:
                [{
                    url: "json/trSchedEvents.php",
                    color: '#F56D3F'
                },
                {
                    url:"json/available.php",
                    cache: false,
                    lazyFetching: true,
                    type: 'POST',
                    data: {
                        trId: <?php echo $trId; ?>
                    },
                    error: function () {
                        alert('there was an error while fetching events!');
                    },
                    color: "#1de131",
                    rendering: 'background'
                }],
                eventRender: function (event, element) {
                    element.attr('href', 'javascript:void(0);');
                    element.click(function() {
                        var url = "trSchGroupClass.php?contactId=<?php echo $contactId; ?>&classSchedId=";
                        $("#startTime").html(moment(event.start).format('MMM Do h:mm A'));
                        $("#endTime").html(moment(event.end).format('MMM Do h:mm A'));
                        $("#eventInfo").html(event.description);
                        $("#eventLocation").html(event.location);
                        $("#editSched").attr('href', url + event.id);
                        $("#eventContent").dialog({ modal: true, title: event.title, width:500});
                    });
                }
            });
        });
    </script>

    <style type="text/css">
        body {
            background: url("images/trsignup.jpg") no-repeat fixed 50% 50%;
            background-size: cover;
        }

        .fc table {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div id="topbanner">
        <?php include_once 'includes/inc.trainer.banner.php' ?>
    </div><!--end topbanner-->
    <div id="trDWrap">
        <div id="trDLeftT">
            <div id="sideNavCont">
                <a href="trProfile.php?contactId=<?php echo $contactId; ?>" ><input type="button" class="btn" value="Edit Profile"</a><br/>
                <a href="trSchGroupClass.php?contactId=<?php echo $contactId; ?>"><input type="button" class="btn" value="Schedule a Class"/></a><br/>
                <a href="trClass.php?contactId=<?php echo $contactId; ?>" ><input type="button" class="btn" value="Add/Edit Class Type"</a><br/>
                <a href="trLocation.php?contactId=<?php echo $contactId; ?>" ><input type="button" class="btn" value="Add/Edit Location"</a><br/>
            </div><!--end sideNavCont-->
        </div><!--end trDLeftT-->
        <div id="trDCenterT">
            <div id="centContain">Various metrics will go here???</div><!--centContain-->
        </div><!--end trDCenterT-->
        <div id="trDRightT">
            <div id="trdcalendar"></div>
        </div><!--end trRightT-->
        <!--modal content box-->
        <div id="eventContent" title="Event Details" style="display:none;">
            Start: <span id="startTime"></span><br>
            End: <span id="endTime"></span><br><br>
            Location: <span id="eventLocation"></span><br/>
            <p id="eventInfo"></p>
            <p><strong><a id="editSched" href="">Edit Schedule</a></strong></p>
        </div>
    </div><!--end trDWrap-->

    <div id="botbanner" class="botfix">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>
