<?php
include('connection.php');
$errors = array();


if (isset($_POST['Create'])) {
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password != $cpassword) {
        array_push($errors, "Passwords do not match.");
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $email = $_SESSION['email'];
        $stmt = $con->prepare("UPDATE customer SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            echo "<script>alert('Password Changed Successfully! $email'); location.href='login.php';</script>";
            exit;
        } else {
            array_push($errors, "Failed to update password.");
        }
    }
}
// $stmt: This variable is used to store a prepared statement. Prepared statements are a way to execute SQL queries securely by separating the query structure from the data being passed into it. They help prevent SQL injection attacks.

// $connection->prepare(): This line prepares a SQL statement for execution. The SQL statement passed as a parameter will be executed later. In this case, it's an SQL UPDATE statement that updates the 'password' field in the 'customer' table where the 'email' matches a certain value.

// bind_param("ss", $hashed_password, $email): This line binds parameters to the prepared SQL statement. Binding parameters allows you to safely pass data into the SQL query. The "ss" indicates that we are binding two string parameters. $hashed_password and $email are the values that will be substituted into the SQL query in place of the question marks (?). This ensures that the values are properly escaped and prevents SQL injection attacks.
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./links.php') ?>
    
    <title>Reset password</title>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="content1 fix">
        <div class="wrapper">
            <div class="title">
                Reset Password
            </div>
            <form action="" method="post">
                <?php include('errors.php'); ?>
                <div class="field">
                    <input type="password" name="password" id="password" placeholder="">
                    <label for="password">New Password:</label>
                </div>
                <div class="field">
                    <input type="password" name="cpassword" id="cpassword" placeholder="">
                    <label for="cpassword">Confirm Password:</label>
                </div>

                <div class="togglebtn">
                    <div class="checkbox">
                        <input class="p-2" type="checkbox" id="pass" onclick="showpassword()">
                        <label for="pass">Show password</label>
                    </div>
                </div>
                <div class="field">
                    <input type="submit" value="Reset" name="Create">
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