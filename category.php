<?php
include('connection.php');

if (!isset($_GET['id'])) {
    header('location: index.php');
    exit();
}

$id = mysqli_real_escape_string($con, $_GET['id']);
$cat_res = mysqli_query($con, "select * from categories where id='$id' AND status='1'");
if (mysqli_num_rows($cat_res) == 0) {
    header('location: index.php');
    exit();
}
$cat_row = mysqli_fetch_assoc($cat_res);
$category_name = $cat_row['categories'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Fitgears - <?php echo htmlspecialchars($category_name); ?>
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

                <!-- STORE -->
                <div id="store" class="col-md-12">
                    <!-- store products -->
                    <div class="row">
                        <?php
                        $res = mysqli_query($con, "select * from products where status='1' AND categories_id='$id'");
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                                <!-- product -->
                                <div class="col-md-3 col-xs-8">
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

                                            <h3 class="product-name"><a href="#"><?= substr($row['product_name'],0,20); ?>...</a></h3>
                                            <h4 class="product-price">₹<?= $row['mrp'] ?>/- <del class="product-old-price">₹<?= $row['price'] ?>/-</del></h4>
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
                            echo "<div class='col-md-12'><p class='text-center'>No products found in this category.</p></div>";
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
    <?php include('./footer.php') ?>

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

</body>

</html>
