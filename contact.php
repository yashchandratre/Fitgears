<?php
include("./connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$errors = array();


if (isset($_POST['sendmail'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $metch = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
  if (empty($name)) {
    array_push($errors, "Full name is Required");
  }
  if (empty($email)) {
    array_push($errors, "Email is Required");
  }
  if (empty($message)) {
    array_push($errors, "Message is Required");
  }
  // if ((preg_match($email, $match))) {
  //   array_push($errors, "Please Enter the Correct Email!");
  // }

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
      $mail->addAddress('fitgears.ecom@gmail.com', 'FitGears');     //Add a recipient


      // //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Customer inquiry';
      $mail->Body    = "Sender Name - $name <br> Sender Email - $email <br> Message - $message";
      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      array_push($errors, "<script>alert('message has been sent');</script>");
    } catch (Exception $e) {
      array_push($errors, "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('./links.php')?>
  <title>Contact Form</title>
  <style>

  </style>
</head>

<body class="b">

  <?php include('header.php') ?>
  <?php include('navigation.php') ?>
  
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29772.540763691697!2d73.08322850859717!3d21.129798554846047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be0676962062319%3A0x42a65da81e176ab3!2sBardoli%2C%20Gujarat%20394601!5e0!3m2!1sen!2sin!4v1709368463501!5m2!1sen!2sin" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
 
  <section id="contact_us" class="contact1">
    <div class="content">
      <h2 class="text-primary">Contact Us</h2>
      
    </div>
    <div class="container2">
      <div class="contactInfo">
        <div class="box">
          <div class="icon"><i class="fa fa-map-marker"></i></div>
          <div class="text">
            <h3 class="text-primary">Address</h3>
            <p>Hirachand Nagar, Bardoli.</p>
          </div>
        </div>
        <div class="box">
          <div class="icon"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
          <div class="text">
            <h3 class="text-primary">Phone</h3>
            <p>+91 7622824577</p>
          </div>
        </div>
        <div class="box">
          <div class="icon"> <i class="fa fa-envelope" aria-hidden="true"></i></div>
          <div class="text">
            <h3 class="text-primary">Email</h3>
            <p>fit.gears01@gmail.com</p>
          </div>
        </div>
      </div>
      <div class="contactForm">
        <form action="" method="post">
          <?php include('errors.php') ?>
          <h2>Send Message</h2>
          <div class="inputbox">
            <input type="text" id="Name" name="name" placeholder="">
            <span>Full Name</span>

          </div>
          <div class="inputbox">
            <input type="text" id="Mail" name="email" placeholder="">
            <span>Email</span>

          </div>
          <div class="inputbox">
            <textarea id="Message" placeholder="" name="message" rows="4"></textarea>
            <span>Message</span>

          </div>
          <input class="btn btn-lg" type="submit" name="sendmail" value="Send">
        </form>
      </div>
    </div>


  </section>

  <?php include('footer.php') ?>
  <script src="./bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
  <script src="./js/scripts.js"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script><!-- for icons  -->
  <?php include('./component/customer/jqueryplugins.php'); ?><!--jquery plugins-->

</body>

</html>