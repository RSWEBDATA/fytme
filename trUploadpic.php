<?php
    if (isset($_GET['contactId'])) {
        $contactId = $_GET['contactId'];
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fytmness Made Easy - Upload Photo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="css/tr.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <style type="text/css">
        body {
            background-image: none;
            background-color: #000000;
        }
    </style>
</head>

<body>
    <div id="topbanner">
        <?php include_once 'includes/inc.trainer.banner.php' ?>
    </div><!--end topbanner-->

    <div id="wrapper">

        <div id="smallpage">
            <h2>Please select a photo to use for your bio picture.  The file size must be under 2 MB.  The pictures should be as close to square as possible.</h2>
            <div style="height:20px"></div><!--spacer-->
            <form enctype="multipart/form-data" method="post" action="upload.php?contactId=<?php echo $contactId; ?>">
                <div>
                    <label for="fileToUpload">Select a File to Upload</label><br /><br/>
                    <input type="file" name="fileToUpload" id="fileToUpload" />
                </div>
                <div id="tr3">&nbsp</div><!--end tr3-->
                <div>
                    <input type="submit" id="uploadPic" class="btn" value="Upload Photo" />
                </div>
            </form>
        </div><!--end smallpage-->
        <div style="height: 50px"></div><!--spacer-->
    </div><!--end wrapper-->
    <div id="botbanner">
        <?php include_once 'includes/inc.botbanner.php'; ?>
    </div><!--end botbanner-->
</body>
</html>