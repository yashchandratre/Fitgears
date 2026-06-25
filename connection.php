<?php
    session_start();
    // session_destroy();
    $con=mysqli_connect('localhost','root','','fitgears');
    if(!$con){
        echo "<script>alert('Database Not Connected!');</script>";
    }
?>
