<?php
    error_reporting(E_ALL);
    $errors = array();

try {

    if(isset($_POST['addtest'])) {

    }

    if (isset($_POST['join'])) {

//        //Validators
//
//        //Letters and Whitespaces only
//        $tfn = trim($_POST['firstName']); //eliminate accidental space
//        if (empty($tfn)) {
//            $errors['firstName'] = 'Please give us your first name.';
//        } else {
//            if (!preg_match('/^[a-zA-Z\s]*$/', $_POST['firstName'])) {
//                $errors['firstName'] = 'Letters and spaces only please.';
//            }
//        }
//
//        //Letters, Numbers, apostrophe's, periods, and Whitespaces
//        $tadd = trim($_POST['address']); //eliminate accidental space
//        if (empty($tadd)) {
//            $errors['address'] = 'Please give us your address';
//        } else {
//            if (!preg_match("/^[a-zA-Z0-9’'. -]+$/", $_POST['address'])) {
//                $errors['address'] = 'Please use appropriate format.';
//            }
//        }
//
//        //password strength validation
//        $tpw = trim($_POST['password']); //eliminate accidental space
//        if (empty($tpw)) {
//            $errors['address'] = 'Please create a password';
//        } else {
//            if (!preg_match("/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $_POST['password'])) {
//                $errors['password'] = 'Must contain upper and lower case letter, numbers, and special characters.';
//            }
//        }
//
//        //Zip Code
//        $tzip = trim($_POST['zip']); //eliminate accidental space
//        if (empty($tadd)) {
//            $errors['zip'] = 'Please give us your address';
//        } else {
//            if (!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST['zip'])) {
//                $errors['zip'] = 'Please give a valid zip code.';
//            }
//        }
//
//        //Telephone
//        $tphone = trim($_POST['phone']); //eliminate accidental space
//        if (empty($tphone)) {
//            $errors['phone'] = 'Please give us your telephone';
//        } else {
//            if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $_POST['phone'])) {
//                $errors['phone'] = 'Please give a valid phone number.';
//            }
//        }
//
//        //Date
//        $tbirthdate = trim($_POST['birthDate']);
//        if (empty($tbirthdate)) {
//            $errors['birthDate'] = "Please give us your birth date.";
//        } else {
//            if (!preg_match("^(?:(1[0-2]|0[1-9])[./-](3[01]|[12][0-9]|0[1-9]))[./-][0-9]{4}$^", $_POST['birthDate'])) {
//                $errors['birthDate'] = 'Please give a valid date as MM/DD/YYYY.';
//            }
//        }

        //datetime
        if (!preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $_POST['dateTime'])) {
            $errors['dateTime'] = "Use a good time stamp.";
        }
//
//            //Email address
//        $temail = trim($_POST['email']);
//        if (empty($temail)) {
//            $errors['email'] = 'Please give us a valid email format.';
//        } else {
//            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//                $errors['email'] = "Please use a valid email format.";
//            }
//        }
//
//        //Social Security
//        $tssn = trim($_POST['ssn']);
//        if (empty($tssn)) {
//            $errors['ssn'] = 'Please enter your Social Security Number.';
//        } else {
//            if (!preg_match("^\d{3}-\d{2}-\d{4}$^", $_POST['ssn'])) {
//                $errors['ssn'] = 'Please give a valid Social Security Number as such xxx-xx-xxxx.';
//            }
//        }
        //no validation for textarea inputs.  Too many variables.  Mysqli_real_escape_string only.



        if (!$errors) {
            $firstName = mysqli_real_escape_string($dbconn, $_POST['firstName']);
            $password = md5($_POST['password']);
            $add1 = mysqli_real_escape_string($dbconn, $_POST['address']);
            $zip = mysqli_real_escape_string($dbconn, $_POST['zip']);
            $phone = preg_replace("/[^0-9]/", "", $_POST['phone']); //trim to only numbers
            $birthDate = date('Y-m-d', strtotime($_POST['birthDate']));
            $email = mysqli_real_escape_string($dbconn, $_POST['email']);
            //if checkboxes are handled individually, they don't need escape as coding sets the value. But must verify they are checked.
            if (isset($_POST['cpr'])) {
                $cpr = $_POST['cpr'];
            } else {
                $cpr = '';
            }
            if (isset($_POST['bkg'])) {
                $bkg = $_POST['bkg'];
            } else {
                $bkg = '';
            }

            //Use this to test your insert queries.
//            if ($dbconn->query($sqlInsertAL) === TRUE) {
//                echo "New record created successfully";
//            } else {
//                echo "Error: " . $sqlInsertAL . "<br>" . $dbconn->error;
//            }
            echo $_POST['dateTime'];
            //format mysql dateTime to readable
//            H is used for military time
//            h is used for 12 digit time
//            i stands for minutes
//                         s seconds
//            a will return am or pm (use in uppercase for AM PM)
//                m is used for months with digits
//            d is used for days in digit
//            Y uppercase is used for 4 digit year (use it lowercase for two digit)
//            M uppercase will echo out month in words
            $sample = "2014-03-02 15:43:34";
            $datetime = strtotime($sample);
            $date = date('M-d-Y', $datetime);
            $time = date('h:i:s a', $datetime);
            echo $time;
            echo $date;
//            header("location: test2.php?");
        }
    }



} catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}