 <?php include("../partials/navigation-bar.php"); ?>
 <?php include("../partials/cart-popup.php"); ?>

 <!-- search-food Section -->
 <section class="search-food">
     <div class="container">
         <form action="search-food.php" method="POST">
             <input type="search" name="searched-food" id="searched-food" placeholder="Search your favourite food..." autocomplete="off" required>
             <input type="submit" name="submit" value="&#128269; Search">
         </form>
         <div class="active-hour btn">
             <span> Active Hours<br> 7:00 AM - 10:00 PM </span>
         </div>
     </div>

 </section>
 <!-- search-food section ends here -->

 <!-- categories section starts here -->
 <section class="categories">
     <div class="container">
         <h2 class="text-center"> Featured Categories</h2>
         <div class="cat-grid-container">

             <?php
                $sql = "SELECT * FROM tbl_category WHERE featured = 'Yes' AND available = 'Yes' LIMIT 4 ";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $title = $rows['title'];
                            $image = $rows['image_name'];
                            // $featured = $rows['featured'];
                            // $available = $rows['available'];


                ?>
                         <div class="box">

                             <a href="<?php echo SITEURL . "main/food-menu.php?category=" . $title ?>"> <img src="<?php echo '../images/categories/' . $image; ?>" alt="<?php echo $title ?>" class="image-responsive box-image">
                                 <h3 class="food-title"> <?php echo $title ?> </h3>
                             </a>
                         </div>
             <?php
                        }
                    }
                }
                ?>
         </div>

     </div>
 </section>
 <!-- categories section ends here -->


 <!-- food-menu section starts here -->
 <section class="food-menu">
     <div class="container">
         <h2 class="text-center"> Featured Foods</h2>
         <div class="menu-grid-container">
             <?php
                $sql = "SELECT * FROM tbl_menu WHERE featured = 'Yes' AND available = 'Yes' LIMIT 6 ";
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
                                         <?php if (!isset($_SESSION['user-id'])) : ?>
                                             <span class="login-pop-up"><img src="../images/cart.png" alt="cart-icon" class="image-responsive"></span>

                                         <?php else: ?>
                                             <span class="cart-pop-up" data-food-item-id="<?php echo $food_item_id; ?>" data-title="<?php echo $title; ?>" data-price="<?php echo $price; ?>" data-description="<?php echo $description; ?>" data-image="<?php echo '../images/menu/' . $image; ?>"><img src="../images/cart.png" alt="cart-icon" class="image-responsive"> </span>

                                         <?php endif; ?>
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
 </section>
 <!-- food-menu section ends here -->

 <!-- footer section -->
 <?php include("../partials/footer.php"); ?>

 <script src="../javascript/cart-popup.js"></script>
 <script src="../javascript/login-popup.js"></script>