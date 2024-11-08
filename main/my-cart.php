<?php include("../partials/navigation-bar.php"); ?>

<!-- Delete category form starts here -->
<div class="form delete-form" style="width: 30%;">
    <span class="cross">&times;</span>
    <br>
    <div class="form-heading">Delete Category</div>
    <div class="confirm-delete-qsn">Delete the category permanently.</div>
    <form action="delete-category.php" method="post">
        <input type="hidden" name="form_id" value="delete-category-form" />
        <input type="hidden" name="id" id="delete-category-id" />
        <input type="hidden" name="image" id="delete-category-image" />


        <input type="submit" name="submit" value="Delete" class=" submit-button delete-yes" />
        <span class="cross submit-button delete-no "> Cancel</span>
        <div class="clear-fix"></div>


    </form>
</div>
<!-- delete-category form stops here! -->

<div class="container">
    <h2 style="text-align: center; margin: 1%;"> My Cart </h2>
    <div class="items-list-table">
        <!-- <table style="width: 80%; margin: auto; "> -->
        <table class="table-full">

            <tr>
                <th>Food-items</th>
                <th>Quantity</th>
                <th> Total Price </th>
                <th>Actions</th>


            </tr>

            <?php
            $user_id = $_SESSION['user-id'];
            $sql = "SELECT * FROM tbl_cart WHERE user_id = $user_id ";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $food_item_id = $rows['food_item_id'];
                        $quantity = $rows['quantity'];
                        $total_price = $rows['total_price'];


                        $inner_sql = "SELECT title, price, image_name FROM tbl_menu WHERE id = $food_item_id ";
                        $inner_res = mysqli_query($conn, $inner_sql);

                        if (mysqli_num_rows($inner_res) == 1) {
                            $inner_row = mysqli_fetch_assoc($inner_res);
                            $food_item = $inner_row['title'];
                            $image = $inner_row['image_name'];
                            $price = $inner_row['price'];
                        }


            ?>
                        <tr>
                            <td>
                                <div class="food-menu-box">

                                    <div class="food-menu-image">
                                        <img src="<?php echo '../images/menu/' . $image; ?>" alt="<?php echo $food_item; ?>" class="image-responsive">
                                    </div>
                                    <div class="food-details">
                                        <div class="food-name"><?php echo $food_item; ?></div>
                                        <div class="food-price"><?php echo 'Rs.' . $price; ?></div>
                                    </div>
                                    <div class="clear-fix"></div>
                                </div>

                            </td>
                            <td><?php echo $quantity ?></td>
                            <td><?php echo "Rs. " . $total_price; ?> </td>


                            <td>
                                <div>
                                    <span class="table-update-btn">&#9998;Update </span>

                                    <!-- <span class ="table-update-btn">&#9998; Update </span> -->

                                    <span class="table-delete-btn">&#128465;Delete</span>

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


<?php include("../partials/footer.php"); ?>