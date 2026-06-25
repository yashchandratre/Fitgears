<?php
include('./connection.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <?php include('./links.php') ?>
    
   <script>
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
        // Search Modules
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

        function showReviews() {
            reviews = document.querySelector(".all-reviews");
            if (reviews.style.display === 'block') {
                reviews.style.display = 'none';
            } else {
                reviews.style.display = 'block';
            }
        }
    </script>

    <style>
        .product-container {
            margin: 20px;
            padding: 30px;
            display: flex;
            /* justify-content: space-between; */
            /* align-items: center; */
        }

        .product-container .product {
            width: 60%;
            padding: 20px;
            margin-right: 10px;
        }

        .product-container .product img {
            width: 100%;
            height: 500px;
            transition: .3s ease;
            cursor: zoom-in;
        }

        .product-container .product img:hover {
            transform: scale(0.96);
        }

        .product-container .product_description {
            display: flex;
            flex-direction: column;
            width: 40%;
            /* margin-left: 10px; */
            padding: 30px;
        }

        .prodect_desc .product_name {
            color: #0000;
            /* margin-bottom: 20px; */
        }

        .product_price {
            margin-top: 20px;
        }

        .product_price p b {
            font-size: 30px;
            margin-right: 5px;
        }

        .product_purchase {
            transition: .5s ease-in-out;
            margin-top: 20px;
            text-transform: uppercase;
        }

        .product_purchase a:hover {
            transform: scale(.96);
        }

        .product_purchase .btn-wishlist {
            border: 2px solid gray;
        }

       
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <?php include('navigation.php'); ?>
    <div class="">
        <?php
        if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {

            $res = mysqli_query($con, "select * from products where id='" . $_REQUEST['id'] . "'");
            $check = mysqli_num_rows($res);
            if ($check > 0) {
                $row = mysqli_fetch_assoc($res);
                $category_id = $row['categories_id'];
        ?>

                <!-- Product Full details page -->
                <div class="product-container">
                    <div class="product">
                        <a href="./uploaded_images/<?php echo $row['image'] ?>">
                            <img src="./uploaded_images/<?php echo $row['image'] ?>" alt="">
                        </a>
                    </div>
                    
                    <div class="product_descript ion">
                        <div class="product_name">
                            <h1>
                                <?= $row['product_name'] ?>
                            </h1>
                        </div>
                        <div class="product_shortdesc">
                            <p>
                                <?= $row['short_desc'] ?>
                            </p>
                        </div>
                        <?php
                        if (($row['qty'] <= 10) && ($row['qty'] >= 1)) {
                            echo "<h4 class='text-success'>Only " . $row['qty'] . " left hurry up</h4>";
                        }
                        if ($row['qty'] <= 0) {
                            echo "<h4 class='text-danger'>Sold Out</h4>";
                        }



                        ?>
                        <!-- <div class="product_review">
                           
                            <span>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                            <div class="view-reviews">
                                <a id="viewreviews" onclick="showReviews()">View Reviews</a>
                            </div>

                        </div> -->
                      
                       
                        <div class="product_price">
                            <p>
                                <b>₹<?= $row['price'] ?></b>
                                MRP
                                <s>₹<?= $row['mrp'] ?></s>
                            </p>
                            <p class="text-success">inclusive of all taxes</p>
                        </div>
                        <div class="product_purchase">
                            <a class="btn btn-warning mx-1" href="login.php"><ion-icon class="mx-2" name="cart-outline"></ion-icon>Add to Cart</a>
                            <a class="btn btn-wishlist" href="wishlist.php?id=<?= $row['id']; ?>"><ion-icon class="mx-2" name="heart-outline"></ion-icon>Wishllist</a>
                        </div>
                        <!-- More About Products  -->
                        <div class="more_desc my-2 p-2">
                            <b>More About Product</b>
                            <p><?= $row['description']; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Recommendation products -->

                <div class="recommendation">
                    <B class="text-center">Similar Products</B>
                    <!-- SECTION -->
                    <div class="section">
                        <!-- container -->
                        <div class="container">
                            <!-- row -->
                            <div class="row">



                                <!-- Products tab & slick -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="products-tabs">
                                            <!-- tab -->
                                            <div id="tab1" class="tab-pane active">
                                                <div class="products-slick" data-nav="#slick-nav-1">
                                                    <?php
                                                    $res = mysqli_query($con, "select * from products where status='1' AND categories_id='$category_id' limit 6");
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
                                                                <h3 class="product-name"><a href="#"><?= $row['product_name'] ?></a></h3>
                                                                <h4 class="product-price">₹<?= $row['price'] ?>/-<del class="product-old-price">₹<?= $row['mrp'] ?>/-</del></h4>
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
                                                <div id="slick-nav-1" class="products-slick-nav">

                                                </div>
                                            </div>
                                            <!-- /tab -->
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
                </div>
        <?php
            } else {
                header('location:home.php');
                die();
            }
        } else {
            header('location:home.php');
            die();
        }
        ?>
    </div>
    <!-- <script src="../../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
    <!-- <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>for icons  -->
    <!-- <script src="../../js/scripts.js"></script> -->
    
    <!-- jQuery Plugins -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/slick.min.js"></script>
    <script src="./js/nouislider.min.js"></script>
    <script src="./js/jquery.zoom.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!--jquery -->
    
    <?php include('./footer.php'); ?>
    
</body>

</html>