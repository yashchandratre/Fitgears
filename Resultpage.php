<?php

include("./connection.php");

// if(isset($_POST["quary"])){
// 	$output='';
// 	$res=mysqli_query($con,"select * from products where product_name LIKE '%".$_POST["query"]."%'");
// 	$res1=mysqli_query($con,"select * from categories where categories LIKE '%".$_POST['query']."%'");
// 	$output = "<ul class='search_list'>";
// 	if((mysqli_num_rows($res)>0)){
// 		while($row=mysqli_fetch_assoc($res)){
// 			$output .='<li>'.$row["product_name"].'</li>';
// 		}
// 		// while($row=mysqli_fetch_assoc($res1)){
// 		//     $output .='<li>'.$row["categories"].'</li>';
// 		// }
// 	}
// 	else
// 		$output .='<li>Product/category Not Found</li>';
// 	}
// 	$output='</ul>';
// 	echo "$output";

// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Fitgears
    </title>
    <?php include('./links.php') ?>
    <style>
        .res {
            min-height: 70vh;
        }
    </style>

</head>


<body>
    <?php include('header.php'); ?>
    <?php include('navigation.php'); ?>
    <div class="container">
        <h1 class="text-center text-danger">Search Result</h1>
    </div>
    <!-- SECTION -->
    <div class="section res">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">


                <!-- STORE -->
                <div id="store" class="col-md-12">
                    <!-- store products -->
                    <div class="row">
                        <!-- SECTION -->
                        <div class="section">
                            <!-- container -->
                            <div class="container">
                                <!-- row -->
                                <div class="row">


                                    <!-- STORE -->
                                    <div id="store" class="col-md-12">
                                        <!-- store products -->
                                        <div class="row">
                                            <?php
                                            $res1 = mysqli_query($con, "select id from categories where status='1' AND categories LIKE '%" . $_REQUEST['search'] . "%'");
                                            if (mysqli_num_rows($res1) > 0) {
                                                $row1 = mysqli_fetch_assoc($res1);
                                                $id = $row1['id'];
                                            } else {
                                                $id = '0';
                                            }
                                            $res = mysqli_query($con, "select * from products where status='1' AND product_name LIKE '%" . $_REQUEST['search'] . "%' OR categories_id='$id'");
                                            if ((mysqli_num_rows($res) > 0) || (mysqli_num_rows($res1) > 0)) {
                                                while ($row = mysqli_fetch_assoc($res)) {
                                            ?>
                                                    <!-- product -->
                                                    <div class="col-md-4 col-xs-8">
                                                        <div class="product">
                                                            <div class="product-img">
                                                                <img src="./uploaded_images/<?= $row['image'] ?>" alt="">
                                                                <div class="product-label">
                                                                    <span class="sale"><?php
                                                                                        $discount = (($row['mrp'] - $row['price']) / ($row['mrp']) * 100);
                                                                                        echo number_format($discount, 2);
                                                                                        ?>%</span>
                                                                    <span class="new">NEW</span>
                                                                </div>
                                                            </div>
                                                            <div class="product-body">

                                                                <h3 class="product-name"><a href="#"><?= $row['product_name'] ?></a></h3>
                                                                <h4 class="product-price">₹<?= $row['mrp'] ?>/- <del class="product-old-price">₹<?= $row['price'] ?>/-</del></h4>
                                                                <?php
                                                                if (($row['qty'] <= 10) && ($row['qty'] >= 1)) {
                                                                    echo "<h4 class='text-success'>Only " . $row['qty'] . " left hurry up</h4>";
                                                                }
                                                                if ($row['qty'] <= 0) {
                                                                    echo "<h4 class='text-danger'>Sold Out</h4>";
                                                                }
                                                                ?>
                                                                <div class="product-rating">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="product-btns">
                                                                    <button onclick="location.href='login.php'" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>

                                                                    <button onclick="location.href='product.php?id=<?= $row['id'] ?>'" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                                </div>
                                                            </div>
                                                            <div class="add-to-cart">
                                                                <button onclick="location.href='login.php'" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /product -->
                                            <?php
                                                }
                                            } else {
                                                echo "<p class='text-center text-dark'>No Result Fount</p>";
                                            }
                                            ?>


                                        </div>

                                        <!-- /store products -->
                                    </div>
                                    <!-- /STORE -->
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /container -->
                        </div>
                        <!-- /SECTION -->



                    </div>
                    <!-- /store products -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->






    <!-- jQuery Plugins -->

    <?php include('footer.php'); ?>
    <?php include('./components/customer/jqueryplugins.php'); ?>

    <script>
        function addToCart(productName, price) {
            alert(`Added ${productName} to cart. Price: $${price}`);
            // You can add more complex functionality here to manage the cart
        }

        //slider code
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 5,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
        // jQuery

        $(document).ready(function() {
            $("#search").keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    $.ajax({

                        url: "searchresult.php",
                        method: "POST",
                        data: {
                            query: query
                        },
                        success: function(data) {

                            $('#search_list').fadeIn();
                            $("#search_list").html(data);
                        }

                    });
                    // alert("in if block");
                } else {
                    // alert("Query Failed")
                    $('#search_list').fadeOut();
                    $("#search_list").html("");
                }
            });
            $(document).on('click', 'li', function() {
                $('#search').val($(this).text());
                $('#search_list').fadeOut();
            });
        });
    </script>
</body>

</html>