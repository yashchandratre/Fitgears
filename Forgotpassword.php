<?php
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// initializing variables
$username = "";
$email    = "";
$errors = array();
if (isset($_POST['getotp'])) {
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
    if (mysqli_num_rows(mysqli_query($con, "select * from customer where email='$email'")) == 0) {
        array_push($errors, "Email is Not Registered yet!");
    }
    if (count($errors) == 0) {
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
            $mail->addAddress($email, $_SESSION['Fullname']);     //Add a recipient
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
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

            header('location: recover.php');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./links.php') ?>
   
    <title>Verification</title>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="content1 fix">
        <div class="wrapper">
            <div class="title">
                Forgot Password
            </div>
            <form action="#" method="post">
                <?php include('errors.php'); ?>
                <div class="field">
                    <input type="text" name="email" placeholder="">
                    <label>Enter Email:</label>
                </div>

                <div class="field">
                    <input type="submit" value="getotp" name="getotp">
                </div>


            </form>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="./bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script><!-- for icons  -->
</body>

</html>