<?php
include('connection.php');
$errors = array();
if (isset($_POST['verify'])) {
    $otp_code = mysqli_real_escape_string($con, $_POST['otp_code']);
    $otp = $_SESSION['otp'];
    if ($otp == $otp_code) {
        echo "<script>alert('You Successfully Register');</script>";
        header('Location: resetpassword.php');
    } else {
        array_push($errors, "Please Enter The Correct Otp!");
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
                Otp Verification
            </div>
            <form action="" method="post">
                <?php include('errors.php'); ?>
                <div class="field">
                    <input type="text" name="otp_code" placeholder="">
                    <label>Enter Otp:</label>
                </div>

                <div class="field">
                    <input type="submit" value="verify" name="verify">
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