<?php include("../partials/admin-navigation-bar.php"); ?>


<!-- add-food input form starts here! -->
<div class="overlay"> </div>
<div class="form add-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Add Food</div>
    <form action="add-food.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_id" value="add-food-form" />
        <div style="width: 65%;float:left;">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Title" required>
        </div>
        <div style="width: 25%;float:right;">
            <label for="price">Price(Rs):</label>
            <input type="number" id="price" name="price" step="0.01" placeholder="00.00" required>
        </div>
        <div class="clear-fix"></div>
        <div>
            <label for="image">Select Image:</label>
            <input type="file" id="image" name="image" placeholder="Select Image" required>
        </div>
        <div>
            <label for="description">Food Description: </label>
            <textarea id="description" name="description" rows="2" cols="40" placeholder="Enter food description here" required></textarea>
        </div>

        <div>
            <label for="category">Category:</label>
            <select name="category" style="width: 65%;" required>

                <?php

                $sql = "SELECT * FROM tbl_category WHERE available = 'Yes' ";

                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {

                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];

                ?>
                            <option value="<?php echo $id ?>"> <?php echo $title ?> </option>

                        <?php


                        }
                    } else {
                        ?>
                        <option value="0">No categories </option>

                <?php

                    }
                }
                ?>
            </select>
        </div>
        <div style="width: 40%;float:left">
            <label style="margin:4% 0;">Featured:</label>
            <input type="radio" id="featured-yes" name="featured" value="Yes"><label for="featured-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="featured-no" name="featured" value="No"><label for="featured-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <div style="width: 35%;float:right;">
            <label style="margin:4% auto;">Available:</label>
            <input type="radio" id="available-yes" name="available" value="Yes"><label for="available-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="available-no" name="available" value="No"><label for="available-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <div class="clear-fix"></div>

        <input type="submit" name="submit" value="Add Food" class="form-add-btn submit-button" style="margin: 8% 0 4%;">
    </form>
</div>
<!-- add-food input form stops here! -->


<!-- update-food form starts here -->
<div class="form  update-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Update Food</div>

    <form action="update-food.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_id" value="update-food-form" />
        <input type="hidden" name="id" id="update-food-id">
         
        <div style="width: 65%;float:left;">
            <label for="update-food-title">Title:</label>
            <input type="text" id="update-food-title" name="title" required>
        </div>
        <div style="width: 25%;float:right;">
            <label for="update-food-price">Price(Rs):</label>
            <input type="number" id="update-food-price" name="price" step="0.01" required>
        </div>
        <div class="clear-fix"></div>
        <div>
            <label for="new-category-image">Update Image:</label>
            <input type="file" id="new-food-image" name="image">
            <input type="hidden" name="existing-image" id="existing-image">

        </div>
        <div>
            <label for="update-food-description">Food Description: </label>
            <textarea id="update-food-description" name="description" rows="2" cols="40" required></textarea>
        </div>
        <div>
            <label for="food-category-id">Category:</label>
            <select id="food-category-id" name="category" style="width: 65%;" required>

                <?php

                $sql = "SELECT * FROM tbl_category WHERE available = 'Yes' ";

                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {

                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];

                ?>
                            <option value="<?php echo $id ?>"> <?php echo $title ?> </option>

                        <?php


                        }
                    } else {
                        ?>
                        <option value="0">No categories </option>

                <?php

                    }
                }
                ?>
            </select>
        </div>
        <div style="width: 40%;float:left">
            <label style="margin:4% 0;">Featured:</label>
            <input type="radio" id="update-featured-yes" name="featured" value="Yes"><label for="featured-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="update-featured-no" name="featured" value="No"><label for="featured-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <div style="width: 35%;float:right;">
            <label style="margin:4% auto;">Available:</label>
            <input type="radio" id="update-available-yes" name="available" value="Yes">
            <label for="update-available-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="update-available-no" name="available" value="No">
            <label for="update-available-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <div class="clear-fix"></div>

        <input type="submit" name="submit" value="Update Food" class="form-update-btn submit-button" style="margin: 8% 0 4%;">
    </form>
</div>
<!-- update-food form stops here! -->



<!-- delete-food form starts here -->
<div class="form delete-form" style="width: 30%;">
    <span class="cross">&times;</span>
    <br>
    <div class="form-heading">Delete Food</div>
    <div class="confirm-delete-qsn">Delete the food permanently?</div>
    <form action="delete-food.php" method="post">
        <input type="hidden" name="form_id" value="delete-food-form" />
        <input type="hidden" name="id" id="delete-food-id" />
        <input type="hidden" name="image" id="delete-food-image" />


        <input type="submit" name="submit" value="Delete" class=" submit-button delete-yes" />
        <span class="cross submit-button delete-no "  style="font-size: 18px; padding: 10px;"> Cancel</span>
        <div class="clear-fix"></div>
    </form>
</div>
<!-- delete-food form stops here! -->


<!-- Main Content Section starts here -->

<section class="main-content">
    <div class="container" style="width:90%;">

        <!--  notification-msg box-->

        <?php if (isset($_SESSION['notification_msg'])): ?>
            <div class="notification-msg">
                <?php echo $_SESSION['notification_msg']; ?>
                <span class="cross cross1">&times;</span>
            </div>
            <script src="../javascript/notification-msg.js"></script>
            <?php unset($_SESSION['notification_msg']); // Clear the message after displaying 
            ?>
        <?php endif; ?>

        <div class="page-heading">
            <h2> Manage Menu</h2>
        </div>

        <span class="btn-primary add-new-btn">Add Food</span>

        <form action="" method="GET">
        <button type="submit" name="filter" id="filter-date" value="date" class="filter-button">Sort By Date</button>
        <button type="submit" name="filter" id="filter-category" value="category" class="filter-button">Sort By Category</button>
        <button type="submit" name="filter" id="filter-title" value="title" class="filter-button">Sort By Title</button>
    </form>
    <div class="clear-fix"></div>

        <div class="items-list-table">
            <table class="table-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th> Price</th>
                    <th>Image</th>
                    <th> Category </th>
                    <th>Description</th>
                    <th style="text-align:center;">Featured</th>
                    <th style="text-align:center;">Available</th>
                    <th>Actions</th>


                </tr>

                <?php
                  // Determine the sort order based on query parameters
                  $sort = isset($_GET['filter']) ? $_GET['filter'] : ''; // Default to sorting by title
                  if($sort === 'date'){
                    $order = 'date DESC';
                    echo "
                <script> 
                document.getElementById('filter-date').classList.add('filter-active');
                </script>";

                }
                  elseif($sort === 'category'){
                      $order = 'category ASC';
                      echo "
                  <script> 
                  document.getElementById('filter-category').classList.add('filter-active');
                  </script>";
  
                  }
                  else{
                    $order = 'title ASC';
                    echo "
                <script> 
                document.getElementById('filter-title').classList.add('filter-active');
                </script>";
                }
               
                $sql = "SELECT * FROM tbl_menu ORDER BY $order ";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image = $row['image_name'];
                            $description = $row['food_description'];
                            $category = $row['category'];
                            $featured = $row['featured'];
                            $available = $row['available'];


                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td style="width:12%;"><?php echo $title; ?></td>
                                <td style="width:10%;"><?php echo "Rs." . $price; ?></td>
                                <td style="width: 12%; overflow:hidden; padding:3px;" ;><img src='<?php echo "../images/menu/" . $image; ?>' style="width: 100%; margin: 0 auto;"></td>
                                <td>
                                    <?php
                                    $sql_category = "SELECT title FROM tbl_category  WHERE id = $category ";
                                    $res_category = mysqli_query($conn, $sql_category);
                                    if ($res) {
                                        $row_category = mysqli_fetch_assoc($res_category);
                                        if ($row_category) {
                                            $category_name =  $row_category['title'];
                                        } else {
                                            $category_name = "Not specified";
                                        }
                                        echo $category_name;
                                    }

                                    ?>
                                </td>
                                <td style="width: 20%;"><?php echo $description; ?></td>
                                <td style="width: 8%;"><?php echo $featured; ?></td>
                                <td style="width: 8%;"><?php echo $available; ?></td>


                                <td>
                                    <div>
                                        <span class="table-update-btn" data-id="<?php echo $id; ?>" data-title="<?php echo $title; ?>" data-price="<?php echo $price; ?> " data-image="<?php echo $image; ?>" data-description="<?php echo $description; ?>" data-category="<?php echo $category; ?> " data-featured="<?php echo $featured; ?>" data-available="<?php echo $available; ?>">&#9998;Update </span>
                                        <br> <br>
                                        <span class="table-delete-btn" data-item-id="<?php echo $id; ?>" data-image="<?php echo $image; ?>">&#128465;Delete</span>

                                    </div>
                                </td>
                            </tr>

                <?php
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</section>

<!-- Adding the javascirpt file -->
<script src="../javascript/manage-food.js"></script>

<?php include("../partials/admin-footer.php"); ?>
