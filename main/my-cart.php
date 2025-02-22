<?php include("../partials/navigation-bar.php"); ?>

<?php if (isset($_SESSION['user-id'])) : ?>
    
<div >

    <!-- remove cart-items -->
    <form action="<?php echo SITEURL . 'customer-backend/remove-cart-item.php'; ?>" id="remove-cart-item-form" method="post">
        <input type="hidden" name="form-id" value="remove-cart-item-form">
        <input type="hidden" name="redirect-uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        <input type="hidden" name="user-id" value="<?php echo $_SESSION['user-id']; ?>">
        <input type="hidden" name="food-item-id" id="food-item-id">
    </form>

    <!-- update food-item quantity -->
    <form action="<?php echo SITEURL . 'customer-backend/update-cart-quantity.php'; ?>" id="update-cart-quantity-form" method="post">
        <input type="hidden" name="form-id" value="update-cart-quantity-form">
        <input type="hidden" name="redirect-uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        <input type="hidden" name="user-id" value="<?php echo $_SESSION['user-id']; ?>">
        <input type="hidden" name="food-item-id" id="update-food-item-id">
        <input type="hidden" name="quantity" id="quantity">
    </form>
</div>

<div class="container">
    <h2 style="text-align: center; margin: 1%;">Items in the cart:</h2>
    <div class="items-list-table">
        <table class="table-full">

            <tr>
                <th>Food-items</th>
                <th>Quantity</th>
                <th> Total Price </th>
            </tr>

            <?php
            $cart_empty = true;
            $user_id = $_SESSION['user-id'];
            $grand_total_price = 0.0;
            $sql = "SELECT * FROM tbl_cart WHERE user_id = $user_id ";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    $cart_empty = false;
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $food_item_id = $rows['food_item_id'];
                        $quantity = $rows['quantity'];

                        $inner_sql = "SELECT title, price, image_name FROM tbl_menu WHERE id = $food_item_id ";
                        $inner_res = mysqli_query($conn, $inner_sql);

                        if (mysqli_num_rows($inner_res) == 1) {
                            $inner_row = mysqli_fetch_assoc($inner_res);
                            $food_item = $inner_row['title'];
                            $image = $inner_row['image_name'];
                            $unit_price = $inner_row['price'];

                            $total_price = $quantity * $unit_price;

                            $grand_total_price += (float)$total_price;
                        }
            ?>
                        <tr>
                            <td style="width: 45%;">
                                <div class="food-item-box">

                                    <div class="food-item-image">
                                        <img src="<?php echo '../images/menu/' . $image; ?>" alt="<?php echo $food_item; ?>" class="image-responsive">
                                    </div>
                                    <div class="food-item-details">
                                        <div class="food-item"><?php echo $food_item; ?></div>
                                        <div class="food-item-price"><?php echo 'Rs.' . $unit_price; ?></div>
                                        <div>
                                            <span class="table-delete-btn" data-food-item-id="<?php echo $food_item_id; ?>">&#128465;Remove</span>
                                        </div>
                                    </div>
                                    <div class="clear-fix"></div>
                                </div>

                            </td>
                            <td style="width: 30%;">
                                <input style="width:25%; height:30px; text-align: center;"  type="number" class="item-quantity" data-food-item-id="<?php echo $food_item_id; ?>" value="<?php echo $quantity ?>" min="1" required>
                                <span class="table-update-btn" data-food-item-id="<?php echo $food_item_id; ?>">&#9998;Update</span>
                            </td>

                            <td class="total-price" data-food-item-id="<?php echo $food_item_id; ?>" data-unit-price = "<?php echo $unit_price ?>" ><?php echo "Rs. " .$total_price; ?> </td>
                        </tr>

            <?php
                    }
                    $grand_total_price = round($grand_total_price, 2);
                }
            }
            ?>
            <tr>
                <td></td>
     
                <td class="grand-total-row" style="border-top: 1.5px solid rgba(47, 54, 69, 0.3);">Grand-total:</td>
                <td class="grand-total-row" style="border-top: 1.5px solid rgba(47, 54, 69, 0.3);"> <?php echo "Rs. " . number_format($grand_total_price, 2) ?> </td>
            </tr>
        </table>
        <?php if($cart_empty === false): ?>
        <a href="<?php echo SITEURL . 'main/checkout.php'; ?>" style="color:white;">
            <div class="checkout-btn">Proceed to Checkout </div>
        </a>
        <?php endif; ?>

    </div>
</div>

<?php include("../partials/footer.php"); ?>

<script src="../javascript/remove-cart-item.js"></script>
<script src="../javascript/update-cart-quantity.js"></script>

<?php endif; ?>

