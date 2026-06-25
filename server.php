<?php
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// initializing variables
$username = "";
$email    = "";
$errors = array();

// user registration
if (isset($_POST['signup'])) {
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
    if (empty($fullname)) {
        array_push($errors, "Fullname is required");
    }
    if (empty($email)) {
        array_push($errors, "email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (!preg_match($pattern, $password)) {

        array_push($errors, "please enter password min 8 character long with spcial character and number and at least on capital lettor!");
    } else {
        // array_push($errors,"Matched ok");
    }
    if ($password !== $cpassword) {
        array_push($errors, "two password does not match");
    }



    if (mysqli_num_rows(mysqli_query($con, "select * from customer where email='$email'")) > 0) {
        array_push($errors, "Email is already exists");
    }

    if (count($errors) == 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($con, "insert into customer(Fullname,email,password) values('$fullname','$email','$password')");
        
        //Load Composer's autoloader
        require './PHPMailer/Exception.php';
        require './PHPMailer/PHPMailer.php';
        require './PHPMailer/SMTP.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'fitgears.ecom@gmail.com';                     //SMTP username
            $mail->Password   = 'dppi mnza azbi rral ';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('fitgears.ecom@gmail.com', 'FitGears');
            $mail->addAddress($email,$_SESSION['Fullname']);     //Add a recipient
            $otp=rand(100000,999999);
            $_SESSION['otp']=$otp;
            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Otp Varification';
            $mail->Body    = "Dear User <br> Your Verification code is <b>$otp</b>";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo "<script>alert('Otp sent to Your Account');</script>";

            header('location: verification.php');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        
    }
}


//  user login
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {

        $res = mysqli_query($con, "select * from customer where email='$email'");
        $res1 = mysqli_query($con, "select * from admin where email='$email'");

        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $verify = password_verify($password, $row['password']);
            if ($verify == 1) {
                // session_destroy();
                $_SESSION['Loggedin'] = true;
                $_SESSION['Fullname'] = $row['Fullname'];
                $_SESSION['Email'] = $row['email'];
                // header('location: ./components/customer/home.php');
                echo "<script>alert('Login Successfull');location.href='./components/customer/home.php';</script>";
                // header('Location : .\components\customer\home.php');
            } else {
                array_push($errors, "please enter the correct password");
            }
        } else if (mysqli_num_rows($res1) > 0) {
            $row = mysqli_fetch_assoc($res1);
            $verify = password_verify($password, $row['password']);
            if ($verify == 1) {
                $_SESSION['Loggedin'] = true;
                $_SESSION['Fullname'] = $row['Fullname'];
                $_SESSION['Email'] = $row['email'];
                header('location: ./components/admin/home.php');
            } else {
                array_push($errors, "Invalid Credentials !");
            }
        } else {
            array_push($errors, "Invalid Credentials !");
        }
    }
}
