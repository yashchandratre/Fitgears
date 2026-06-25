<?php
    include("./connection.php");
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

</head>


<body>
    <?php include('header.php'); ?>
    <?php include('navigation.php'); ?>

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./assets/p1.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Machines<br>Collection</h3>
                            <a href="category.php?id=2" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./assets/p9.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Weights<br>Collection</h3>
                            <a href="category.php?id=1" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./assets/p8.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Kettlebell<br>Collection</h3>
                            <a href="category.php?id=4" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./assets/p7.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Protien<br>Collection</h3>
                            <a href="category.php?id=5" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./assets/p5.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Fitfood<br>Collection</h3>
                            <a href="category.php?id=6" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./assets/p6.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Accessories<br>Collection</h3>
                            <a href="category.php?id=3" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
            <?php
                            $result = mysqli_query($con, "select * from categories where status='1'");
                            while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                                <!-- section title -->
                                <div class="col-md-9">
                                    <div class="section-title">
                                        <h3 class="title"><?= $rows['categories'] ?></h3>

                                    </div>
                                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <?php
                                    $res = mysqli_query($con, "select * from products where status='1' AND categories_id='" . $rows['id'] . "'");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <!-- product -->
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
                                                <p class="product-category">Category</p>
                                                <h3 class="product-name"><a href="#"><?= substr($row['product_name'],0,20); ?>...</a></h3>
                                                <h4 class="product-price">₹<?= $row['price'] ?>/-<del class="product-old-price">₹<?= $row['mrp'] ?>/-</del></h4>
                                                <?php
													if(($row['qty']<=10)&&($row['qty']>=1)){
														echo "<h4 class='text-success'>Only ".$row['qty']." left hurry up</h4>";
													}
													if($row['qty']<=0){
														echo "<h4 class='text-danger'>Sold Out</h4>";
													}
												?>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>

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
                                        <!-- /product -->

                                    <?php
                                    }
                                    ?>
                                </div>
                                <!-- /tab -->
                                <div id="slick-nav-1" class="products-slick-nav">
                                    <a href="allproducts.php">View more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
                 <?php } ?>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>






    <!-- jQuery Plugins -->

    <?php include('footer.php'); ?>
		<!-- jQuery Plugins -->
		<script src="./js/jquery.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<script src="./js/bootstrap.bundle.min.js"></script>
		<script src="./js/slick.min.js"></script>
		<script src="./js/nouislider.min.js"></script>
		<script src="./js/jquery.zoom.min.js"></script>
		<script src="./js/main.js"></script>
		<script src="./js/scripts.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!-- jquery -->


		

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
    </script>
</body>

</html>