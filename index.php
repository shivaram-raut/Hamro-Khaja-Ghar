 <?php
    include("partials/navigation-bar.php");
    ?>

 <!-- search-food Section -->
 <section class="search-food">
     <div class="container">
         <form action="">
             <input type="search" name="searched-food" id="searched-food" placeholder="Search your favourite food here..." autocomplete="off">
             <input type="submit" name="submit" value="Search">
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
         <p class="text-center add-bottom-padding">We currently serve the following categories of food. Click on your
             favourite category
             to see the menu.</p>
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

                             <a href="<?php echo SITEURL."food-menu.php?category=".$title ?>" > <img src="<?php echo 'images/categories/' . $image; ?>" alt="<?php echo $title ?>" class="image-responsive box-image">
                                 <h3 class="food-title"> <?php echo $title ?> </h3>
                             </a>
                         </div>
             <?php
                        }
                    }
                }
                ?>
         </div>

         <a href="food-categories.php">
             <div class="view-all btn">
                 <span> View All Categories </span>
             </div>
         </a>
     </div>
 </section>
 <!-- categories section ends here -->


 <!-- food-menu section starts here -->
 <section class="food-menu">
     <div class="container">
         <h2 class="text-center"> Featured Foods</h2>
         <p class="text-center add-bottom-padding">These are the popupar foods we serve.</p>
         <div class="menu-grid-container">
             <?php
                $sql = "SELECT * FROM tbl_menu WHERE featured = 'Yes' AND available = 'Yes' LIMIT 10 ";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $title = $rows['title'];
                            $image = $rows['image_name'];
                            $price = $rows['price'];
                            $description = $rows['food_description'];
                ?>

                         <div class="food-menu-box">
                             <div class="food-menu-image">
                                 <img src="<?php echo 'images/menu/' . $image; ?>" alt="<?php echo $title; ?>" class="image-responsive">
                             </div>
                             <div class="food-details">
                                 <div class="food-name"><?php echo $title; ?></div>
                                 <div class="food-price"><?php echo 'Rs.'. $price; ?></div>
                                 <div class="food-description"> <?php echo $description; ?> </div>
                                 <div class="cart-btn">
                                     <a href="#"><img src="images/cart.png" alt="cart-icon" class="image-responsive"></a>
                                 </div>
                             </div>
                             <div class="clear-fix"></div>
                         </div>

             <?php
                        }
                    }
                }

                ?>
         </div>
         <a href="food-menu.php">
             <div class="view-all btn">
                 <span> View All Menu </span>
             </div>
         </a>
     </div>
 </section>
 <!-- food-menu section ends here -->

 <!-- footer section -->
 <?php include("partials/footer.php"); ?>