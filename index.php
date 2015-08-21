<?php


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>FytMe</title>
    <link href="css/splash.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400|Oleo+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Petit+Formal+Script' rel='stylesheet' type='text/css'>
</head>

<body>

    <div id="topbanner">
        <div id="tbleft">
            <div id="logo">
                <img src="images/fytmelogosplashBIG.png" alt="Fytme Logo">
            </div><!--end logo-->
        </div><!--end tbleft-->
        <div id="tbright">
            <h5>COMING SOON!</h5>
        </div><!--end tbright-->
    </div><!--end topbanner-->
    <div id="wrapper">
        <div id="maincontent">
            <h3>
                THE PREMIER<br/>
                ON - DEMAND<br/>
                FITNESS SOLUTION
            </h3>
            <h1><p>Fytness Made Easy</p></h1>
            <h2><p>
                    CONNECT TO LOCAL TRAINERS AND STUDIOS<br/>
                    BOOK SESSIONS WITH A CLICK<br/>
                    NO MEMBERSHIP, PRICING THAT FITS
            </p></h2>
            
            <div style="height: 20px;"></div><!--spacer-->
            <div id="mcform">
                <form action="formmail.php" method="post">
                    <div id="ftr1"><h4>EMAIL</h4><br/><input type="text" id="email" name="email" class="txtinput1"  placeholder="Email Address"/></div><!--end ftr1-->
                    <div id="ftd"><h4>ZIP</h4><br/><input type="text" id="zip" name="zip" class="txtinput" placeholder="Zip Code"/></div><!--end ftd1-->
                    <div id="ftd1"><h4>&nbsp;</h4><br/><input type="submit" id="join" name="join" class="btn" align="left" value="Join the Movement"</div><!--end ftd1-->
                    <input type="hidden" name="recipients" value="jmahan3@gmail.com, stevesmith@epesent.com" />
                    <input type="hidden" name="mail_options"/>
                    <input type="hidden" name="good_url" value="http://fytme.net/thankyou.html" />
                    <input type="hidden" name="subject" value="Sign Me Up"/>
                </form>
            </div><!--end mcform-->
            <div style="height: 30px"></div><!--spacer-->
        </div><!--end maincontent-->
    </div><!--end wrapper-->
</body>
</html>