<!-- HEADER -->

<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="contact.php"><i class="fa fa-phone"></i>+91 7622824573</a></li>
                <li><a href="contact.php"><i class="fa fa-envelope-o"></i>fitgears.ecom@gmail.com</a></li>
                <li><a href="contact.php"><i class="fa fa-map-marker"></i>Hirachand Nagar,Bardoli.</a></li>
            </ul>
            <ul class="header-links pull-right">
                <!--<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>-->
                <li><a href="login.php"><i class="fa fa-user-o"></i> My Account</a></li>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="./assets/logo.png" alt="" width="200" height="100">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                
                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search text-center">
                        <form method="post" action="Resultpage.php">
                            <input class="input" type="search" name="search" id="search" placeholder="Search here">
                            <button type="submit" name="submit" class="search-btn">Search</button>
                            <div id="search_list" class="text-left"></div>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="login.php">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">0</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">
                                    0
                                </div>
                            </a>
                            <div class="cart-dropdown">

                                <div class="cart-list">
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="../../uploaded_images/" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#"></a></h3>
                                            <h4 class="product-price"><span class="qty">0</span>₹0/-</h4>
                                        </div>
                                        <form action="#" method="post">
                                            <input type="text" hidden name="id" value="">
                                            <button type="submit" name="delete" class="delete"><i class="fa fa-close"></i></button>
                                        </form>
                                    </div>
                                </div>



                                <div class="cart-summary">
                                    <small> Item(s) selected</small>
                                    <h5>SUBTOTAL: ₹0</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="cart.php">View Cart</a>
                                    <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
<script>
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