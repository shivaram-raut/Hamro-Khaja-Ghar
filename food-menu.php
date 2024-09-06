<?php include("partials/navigation-bar.php"); ?>

<section class="food-menu">

    <div class="container" style="width:95%;">

        <div class="menu-page-grid">
            <div class="category-bar">
                <div class="sticky-cat-section">
                    <ul class="category-list">
                        <li class="active-menu" data-category="all">
                            All
                        </li>

                        <?php
                        $sql = "SELECT title FROM tbl_category ORDER BY title ASC ";

                        $res = mysqli_query($conn, $sql);

                        if ($res == true) {

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    $category = $rows['title'];
                        ?>
                                    <li data-category="<?php echo $category; ?>"> <?php echo $category; ?> </li>
                        <?php
                                }
                            }
                        }

                        ?>

                    </ul>
                </div>

            </div>

            <div class="menu-list">
                <div class="page-heading text-center">
                    <h1>Our Food Menu </h1>
                </div>
                <div class="menu-grid-container">

                    <?php
                    $sql = "SELECT * FROM tbl_menu WHERE available = 'Yes' ORDER BY category ASC ";
                    $res = mysqli_query($conn, $sql);

                    if ($res == true) {
                        $count = mysqli_num_rows($res);

                        if ($count > 0) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $title = $rows['title'];
                                $image = $rows['image_name'];
                                $price = $rows['price'];
                                $description = $rows['food_description'];
                                $category_id = $rows['category'];

                                $inner_sql = "SELECT title FROM tbl_category WHERE id = $category_id ";

                                $inner_res = mysqli_query($conn, $inner_sql);

                                if ($inner_res == true) {

                                    $inner_count = mysqli_num_rows($inner_res);

                                    if ($inner_count == 1) {
                                        $inner_row = mysqli_fetch_assoc($inner_res);
                                        $food_category = $inner_row['title'];
                                    }
                                }
                    ?>

                                <div class="food-item" data-category="<?php echo $food_category ?>">
                                    <div class="food-menu-box">

                                        <div class="food-menu-image">
                                            <img src="<?php echo 'images/menu/' . $image; ?>" alt="<?php echo $title; ?>" class="image-responsive">
                                        </div>
                                        <div class="food-details">
                                            <div class="food-name"><?php echo $title; ?></div>
                                            <div class="food-price"><?php echo 'Rs.' . $price; ?></div>
                                            <div class="food-description"> <?php echo $description; ?> </div>
                                            <div class="cart-btn">
                                                <a href="#"><img src="images/cart.png" alt="cart-icon" class="image-responsive"></a>
                                            </div>
                                        </div>
                                        <div class="clear-fix"></div>
                                    </div>
                                </div>


                    <?php
                            }
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("partials/footer.php"); ?>

<script src="javascript/filter-menu.js"></script>