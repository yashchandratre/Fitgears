<?php
    include("../../connection.php");
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        mysqli_query($con,"delete from addtocart where id=$id");
        echo "<script>location.href='cart.php';</script>";
        $image=$_GET['img'];
        $path='./uploaded_images/'.$image;
        unlink($path);
    }
?>