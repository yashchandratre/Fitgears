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
	<div class="alin-items">

		<div class="slider-container">
			<button class="prev-btn"><i class="fa-solid fa-angle-left"></i></button>

			<div class="slider">
				<img src="./assets/p1.png" alt="Image 1" class="slide" onclick="location.href='category.php?id=2'">
				<img src="./assets/p2.png" alt="Image 2" class="slide" onclick="location.href='category.php?id=1'">
				<img src="./assets/p3.png" alt="Image 4" class="slide" onclick="location.href='category.php?id=1'">
				<img src="./assets/p4.png" alt="Image 5" class="slide" onclick="location.href='category.php?id=4'">
			</div>

			<button class="next-btn"><i class="fa-solid fa-angle-right"></i></button>
		</div>

	</div>
	<!-- <section class="slid-container">

		<div class="swiper mySwiper">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<img src="./assets/s1.png" alt="">
				</div>
				<div class="swiper-slide">
					<img src="./assets/s2.png" alt="">
				</div>
				<div class="swiper-slide">
					<img src="./assets/s3.png" alt="">
				</div>
				<div class="swiper-slide">
					<img src="./assets/s4.png" alt="">
				</div>

				<div class="swiper-slide">
					<img src="./assets/s1.png" alt="">
				</div>


			</div>

		</div>
	</section> -->

	<!-- SECTION -->
	<div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Weights</h3>

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
                                    $res = mysqli_query($con, "select * from products where status='1' AND categories_id='1'");
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
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
	<!-- /SECTION -->






	<?php include('footer.php'); ?>
    <script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery.min.js"></script>
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