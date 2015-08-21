<?php
error_reporting(E_ALL);
    require_once 'connectdb.php';
    require_once 'testsc.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--JQuery links-->
    <script src="http://code.jquery.com/jquery-2.0.2.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!--datetimepicker-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <link type="text/css" href="css/jquery.simple-dtpicker.css" rel="stylesheet" />
    <script src="js/jquery.simple-dtpicker.js"></script>


    <script type='text/javascript'>
        //*script for selection boxes that fill in inputs and hide or show edit button and disable inputs
        $(function() {
            $('#ftr1').hide();
            $('#choose').change(function() {
                selectedOption = $('option:selected', this);
                $('input[name=address]').val(selectedOption.data('address'));
                $('input[name=city]').val(selectedOption.data('city'));
                $('input[name=state]').val(selectedOption.data('state'));

                var str = "";
                str = parseInt($(this).val());
                if(str == 0) {
                    $('#ftr1').hide();
                    $('input[name=address]').prop('disabled', false);
                    $('input[name=city]').prop('disabled', false);
                    $('input[name=state]').prop('disabled', false);
                } else {
                    $('#ftr1').show();
                    $('input[name=address]').prop('disabled', true);
                    $('input[name=city]').prop('disabled', true);
                    $('input[name=state]').prop('disabled', true);
                }
            });
        });


    </script>

    <style type="text/css">

        body {
            padding: 0;
            margin: 0;
        }

        #wrapper {
            width: 80%;
            background-color: red;
            margin-left: auto;
            margin-top: 110px;
            margin-right: auto;
            margin-bottom: 0;
        }
        #ftr {
            clear: both;
            width: 33%;
            float: left;
            margin-top: 10px;
        }
        #ftr1 {
            clear: both;
            width: 33%;
            float: left;
            margin-top: 10px;
        }
        #ftd {
            float: left;
            width: 33%;
        }
        #tr99 {
            width: 99%;
            clear: both;
            float: left;
            margin: 30px,0 30px 0;
        }

        input {
            max-width: 100%;
        }

        .txtinput {
            width: 90%;
        }
        .error {
            color: red;
        }

        /*css for icons as checkboxes with changing opacity.  See checkbox below for style*/
        label {
            cursor: pointer;
        }
        label img {
            opacity : 0.5;
        }
        input[type=checkbox]:checked + label img {
            opacity : 1;
        }

        /*Datepickercustom*/
        .custom-date-style {
            background-color: red !important;
        }

        /* media Queries */
        @media only screen and (max-width: 1024px) {

        }

        @media only screen and (max-width: 768px) {

        }

        @media only screen and (max-width: 600px) {

        }

        @media only screen and (max-width: 321px) {

        }
    </style>

</head>

<body>

    <div id="wrapper">
        test
        <!--The following is the set up for inputs.  Although all are input:text, each user input is validated differently.  It includes error function for validation purposes.
        The "value" is there to return the inputted value if their is an error in the validation. -->
        <form action="" method="post">

            <div id="ftr">
                <input type="text" id="firstName" name="firstName" class="txtinput" placeholder="First Name" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['firstName'], ENT_COMPAT, 'UTF-8');}?>" />
            </div>
            <div id="ftd">
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['firstName'])) {
                        echo $errors['firstName'];
                    }
                    ?>
                </span>
            </div>

            <div id="ftr">
                <input type="password" id="password" name="password" class="txtinput" placeholder="Password" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['password'], ENT_COMPAT, 'UTF-8');}?>" />
            </div>
            <div id="ftd">
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['password'])) {
                        echo $errors['password'];
                    }
                    ?>
                </span>
            </div>

            <div id="ftr">
                <input type="text" id="address" name="address" class="txtinput" placeholder="Address" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['address'], ENT_COMPAT, 'UTF-8');}?>"/>
            </div>
            <div id="ftd">
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['address'])) {
                        echo $errors['address'];
                    }
                    ?>
                </span>
            </div>

            <div id="ftr">
                <input id="zip" name="zip" class="txtinput" placeholder="Zip" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['zip'], ENT_COMPAT, 'UTF-8');}?>"/>
            </div>
            <div id="ftd">
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['zip'])) {
                        echo $errors['zip'];
                    }
                    ?>
                </span>
            </div>

            <div id="ftr">
                <input id="phone" name="phone" class="txtinput" placeholder="Phone" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['phone'], ENT_COMPAT, 'UTF-8');}?>"/>
            </div>
            <div id="ftd">
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['phone'])) {
                        echo $errors['phone'];
                    }
                    ?>
                </span>
            </div>

            <div id="ftr">
                <input id="birthDate" name="birthDate" class="txtinput" placeholder="Birth Date" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['birthDate'], ENT_COMPAT, 'UTF-8');}?>"/>
            </div>
            <div id="ftd">
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['birthDate'])) {
                        echo $errors['birthDate'];
                    }
                    ?>
                </span>
            </div>

            <div id="ftr">
                <input id="email" name="email" class="txtinput" placeholder="Email Address" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8');}?>"/>
            </div>
            <div id="ftd">
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['email'])) {
                        echo $errors['email'];
                    }
                    ?>
                </span>
            </div>

            <div id="ftr">
                <input id="ssn" name="ssn" class="txtinput" placeholder="Social Security Number" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['ssn'], ENT_COMPAT, 'UTF-8');}?>"/>
            </div>
            <div id="ftd">
                <span class="error">
                    <?php
                    if ($_POST && isset($errors['ssn'])) {
                        echo $errors['ssn'];
                    }
                    ?>
                </span>
            </div>
            <!--Keep selection in case of error-->
            <div id="ftr">
                <select id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" <?php if(isset($_POST['join']) && $_POST['gender'] == 'male'): ?> selected="selected" <?php endif ?>>Male</option>
                    <option value="female" <?php if(isset($_POST['join']) && $_POST['gender'] == 'female'): ?> selected="selected" <?php endif ?>>Female</option>
                </select>
            </div>
            <!--Keep selection in case of error-->
            <div id="ftr">
                <textarea id="bio" name="bio" rows="5" cols="30"><?php if(isset($_POST['join'])) echo $_POST['bio']; ?></textarea>
            </div>
            <!--Keep selection in case of error-->
            <div id="ftr">
                <input type="checkbox" id="cpr" name="cpr" value="cpr" <?php echo (empty($_POST['cpr'])) ? '' : 'checked' ?> />&nbsp;&nbsp;Check for cpr.
            </div>

            <div id="ftr">
                <input type="checkbox" id="bkg" name="bkg" value="bkg" <?php echo (empty($_POST['bkg'])) ? '' : 'checked' ?> />&nbsp;&nbsp;Check for bkg.
            </div>
            <!--Keep selection of dynamically generated list in case of errors (No list is connected to this form)-->
            <div id="ftr">There is no db assigned to this form or list to get the states however code is sound.<br/>State:<br/>
                <select id="state" name="state">
                    <option value="">Select State</option>
                    <?php foreach ($chooseState AS $rowstate) { ?>
                        <option value="<?php echo $rowstate['state_abbr']; ?>" <?php if(isset($_POST['join']) && $_POST['state'] == $rowstate['state_abbr']): ?> selected="selected" <?php endif ?>><?php echo $rowstate['state_abbr'] ?></option>
                    <?php } ?>
                </select>
            </div><!--end td1-->



            <!--Checkbox set up for icon as check box-->
            <div id="ftr">
                Name<br/>
                <input type="checkbox" id="Name" name="Name" value="yes" style="display: none" <?php echo (empty($_POST['Name'])) ? '' : 'checked' ?>/>
                <label for="cpr"><img src="images/cpricon.jpg" alt="cpr"/></label>
            </div>

            <!--datetimepicker requires js files, jquery link, and jquery ui link-->
            <div id="ftr">
                <input id="dateTime" name="dateTime" type="text" >
                <script type="text/javascript">
                    $(function(){
                        $('#dateTime').appendDtpicker({
                            "minuteInterval": 30,
                            "closeOnSelected": true
                        });
                    });
                </script><br>
                 <span class="error">
                    <?php
                    if ($_POST && isset($errors['dateTime'])) {
                        echo $errors['dateTime'];
                    }
                    ?>
                </span>

            </div>

            <!--select box that fills inputs, disables inputs, and enables edit link.  Script should be in head section-->
            <div id="ftr">
                <select id="choose">
                    <option value="0">Add New</option>
                    <option value="1" data-address="678 High" data-city="New Braunfels" data-state="TX">Selection 1</option>
                    <option value="2" data-address="98 Over there" data-city="Austin" data-state="TX">Selection 2</option>
                </select>
            </div>
            <div id="ftr">
                <input type="text" id="address" name="address" placeholder="address"/>
            </div>
            <div id="ftd">
                <input type="text" name="city" placeholder="city"/>
            </div>
            <div id="ftd">
                <input type="text" name="state" placeholder="state"/>
            </div>
            <div id="ftr1">
                <a href="#" id="edit" name="edit">Edit</a>
            </div>

            <script type="text/javascript">
            //sets amount input in proper currency format.
            (function($) {
            $.fn.currencyFormat = function() {
            this.each( function( i ) {
            $(this).change( function( e ){
            if( isNaN( parseFloat( this.value ) ) ) return;
            this.value = parseFloat(this.value).toFixed(2);
            });
            });
            return this; //for chaining
            }
            })( jQuery );


            $( function() {
            $('.currency').currencyFormat();
            });
            </script>
            <div id="ftr">
                <input type="text" id="money" name="money" class="currency"/>
            </div>

            <div id="ftr">Time list
            <select id="time">
                <option value="">Choose a time</option>
                <?php
                for($hours=0; $hours<=48; $hours++) // the interval for hours is '1'
                    for($mins=0; $mins<60; $mins+=30) // the interval for mins is '30'
                        echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                            .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';

                ?>
            </select></div>




            <div id="ftr">
                <input type="submit" id="join" name="join" value="JOIN OUR TEAM" />
                <input type="submit" id="addtest" name="addtest" title="Find the address from name" value="Find Address"/>
            </div>
        </form>
    </div>


</body>
</html>