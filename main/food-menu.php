<?php include("../partials/navigation-bar.php"); ?>
<?php include("../partials/cart-popup.php"); ?>


<section class="food-menu">

    <div class="container" style="width:95%;">

        <div class="menu-page-grid">
            <div class="category-bar">
                <div class="sticky-cat-section">
                    <ul class="category-list">

                        <?php
                        if (isset($_SESSION['searched_food'])): ?>

                            <li class="active-menu">Searched Food</li> 
                            <li data-category="all">
                                All
                            </li>

                        <?php else: ?>

                            <li class="active-menu" data-category="all">
                                All
                            </li>

                        <?php endif; ?>

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
                <!-- search-food Section -->


                <section class="search-menu">
                    <div class="container">
                        <form action="search-food.php" id="search-food-form" method="POST">
                            <?php
                            if (isset($_SESSION['searched_food'])): ?>

                                <input type="search" name="searched-food" id="searched-food" value="<?php echo $_SESSION['searched_food'] ?>" autocomplete="off" required>


                            <?php else: ?>

                                <input type="search" name="searched-food" id="searched-food" placeholder="Search your favourite food..." autocomplete="off" required>

                            <?php endif; ?>

                            <input type="submit" name="search-submit" value="&#128269; Search">
                        </form>

                    </div>

                </section>
                <!-- search-food section ends here -->


                <div class="menu-grid-container">

                    <?php
                    if (isset($_SESSION['searched_food'])) {
                        $search = $_SESSION['searched_food'];
                        $truncated_search = substr($search, 0, -1); //handling the cases for plural of the titles
                        $sql = "SELECT * FROM tbl_menu WHERE title LIKE '%$truncated_search%' OR food_description LIKE '%$truncated_search%' ";
                        unset($_SESSION['searched_food']);
                    } else {
                        $sql = "SELECT * FROM tbl_menu WHERE available = 'Yes' ORDER BY category ASC ";
                    }
                    $res = mysqli_query($conn, $sql);

                    if ($res == true) {
                        $count = mysqli_num_rows($res);

                        if ($count > 0) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $food_item_id = $rows['id'];
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
                                            <img src="<?php echo '../images/menu/' . $image; ?>" alt="<?php echo $title; ?>" class="image-responsive">
                                        </div>
                                        <div class="food-details">
                                            <div class="food-name"><?php echo $title; ?></div>
                                            <div class="food-price"><?php echo 'Rs.' . $price; ?></div>
                                            <div class="food-description"> <?php echo $description; ?> </div>
                                            <div class="cart-btn">
                                                <?php if(!isset($_SESSION['user-id'])) : ?>
                                                <span class="login-pop-up"><img src="../images/cart.png" alt="cart-icon" class="image-responsive"></span>
                                                
                                                <?php else: ?>
                                                <span class="cart-pop-up" data-food-item-id="<?php echo $food_item_id; ?>" data-title="<?php echo $title; ?>" data-price="<?php echo $price; ?>" data-description="<?php echo $description; ?>" data-image="<?php echo '../images/menu/' . $image; ?>"><img src="../images/cart.png" alt="cart-icon" class="image-responsive"> </span>
                                                
                                                <?php endif;?>
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

<?php include("../partials/footer.php"); ?>

<script src="../javascript/cart-popup.js"></script>
<script src="../javascript/login-popup.js"></script>
<script src="../javascript/filter-menu.js"></script>