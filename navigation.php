<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class=""><a href="index.php">Home</a></li>
                <li><a href="allproducts.php">Products</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li class="drop-down">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            categories
                        </a>
                        
                        <ul class="dropdown-menu">
                            <?php
                            $cat_res = mysqli_query($con, "select * from categories where status='1' order by categories asc");
                            while ($cat_row = mysqli_fetch_assoc($cat_res)) {
                                echo '<li><a class="dropdown-item" href="category.php?id=' . $cat_row['id'] . '">' . htmlspecialchars($cat_row['categories']) . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->