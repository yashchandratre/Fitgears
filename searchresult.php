<?php
    include("./connection.php");
    if(isset($_POST["query"])){
        $output='';
        $res=mysqli_query($con,"select * from products where product_name LIKE '%".$_POST["query"]."%' limit 5");
        $res1=mysqli_query($con,"select * from categories where categories LIKE '%".$_POST['query']."%' limit 5");
        $output = '<ul class="search_list list-unnstyled">';
        if((mysqli_num_rows($res)>0) || (mysqli_num_rows($res1)>0)){
            while($row=mysqli_fetch_assoc($res)){
                // echo "<script>alert('".$row['product_name']."');</script>";
                $output .='<li>'.$row['product_name'].'</li>';
            }
            while($row=mysqli_fetch_assoc($res1)){
                $output .='<li>'.$row["categories"].'</li>';
            }
        }
        else{
            $output .='<li>Product/category Not Found</li>';
        }
        $output .='</ul>';
        echo $output;
    }
?>