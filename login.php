<?php
include("server.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Login</title>
   <?php include('./links.php') ?>
   
   <style>
      .togglebtn {
         /* justify-content: left; */
         padding: 10px;
         font-weight: 100;
         font-size: 18px;
      }

      .togglebtn .checkbox {
         align-items: center;
         justify-content: left;
      }
   </style>
</head>

<body>
   <?php include('header.php'); ?>
   <?php include('navigation.php'); ?>
      <div class="wrapper my-4">
         <div class="title">
            Login Form
         </div>

         <form action="login.php" method="post">
            <?php include('errors.php'); ?>
            <div class="field">
               <input type="text" name="email" placeholder="">
               <label>Email Address </label>
            </div>
            <div class="field">
               <input type="password" name="password" id="password" placeholder="">
               <label>Password</label>
            </div>
            <div class="togglebtn">
               <div class="checkbox1">
                  <input class="p-2" type="checkbox" id="pass" onclick="showpassword()">
                  <label for="pass">Show password</label>
               </div>
            </div>
            <div class="content">
               <div class="checkbox1">
                  <input type="checkbox" id="remember-me">
                  <label for="remember-me">Remember me</label>
               </div>
               <div class="pass-link">
                  <a href="Forgotpassword.php">Forgot password?</a>
               </div>
            </div>
            <div class="field">
               <input type="submit" value="Login" name="login">
            </div>
            <div class="signup-link">
               Not a member? <a href="signup.php">Signup now</a>
            </div>
         </form>
      </div>
   <?php include("footer.php"); ?>

   <script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/slick.min.js"></script>
    <script src="./js/nouislider.min.js"></script>
    <script src="./js/jquery.zoom.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!-- 
</body>

</html>