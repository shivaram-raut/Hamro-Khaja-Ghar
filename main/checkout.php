<?php include("../partials/navigation-bar.php"); ?>

<?php
    $user_id = $_SESSION['user-id'];
    $sql = "SELECT * FROM tbl_customer WHERE id = $user_id ";

    $res = mysqli_query($conn, $sql);

    if($res == true){

        $row = mysqli_fetch_assoc($res);
        $full_name = $row['full_name'];
        $_SESSION['full-name']= $full_name;
        $adrs = $row['address'];
        $mobile_number= $row['mobile_number'];
        $email = $row['email'];
    }


?>

<div class="container" style=" width: 90%; padding:5px 3%;">

    <div class="checkout-grid-container">
        <div class="basic-details">
            <div class="header">Basic Details:</div>
            <div class="input-box">
                <div>
                    <label for="full-name">Full Name</label>
                    <input type="text" id="full-name" name="full-name" value="<?php echo $full_name ?>" disabled>
                </div>
                <div>
                    <label for="mobile-number">Mobile Number</label>
                    <input type="tel" id="mobile-number" name="mobile-number" value="<?php echo $mobile_number ?>" disabled>
                </div>

                <div>
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo $email ?>" disabled>

                </div>

                <div>
                    <label for="address">Delivery Location (Modify if needed)</label>
                    <textarea id="address" name="address" rows="2" cols="40" required><?php echo $adrs ?> </textarea>
                </div>
            </div>

        </div>

        <div class="order-details">

            <div class="header">Order Details:</div>

            <table class="checkout-table">
                <tr>
                    <th>S.N.</th>
                    <th> Items </th>
                    <th> Price </th>
                    <th> Quantity</th>
                    <th> Total Price </th>
                </tr>

                <?php
                $grand_total_price = 0.0;
                $sql = "SELECT * FROM tbl_cart WHERE user_id = $user_id ";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        $sn = 1;
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $food_item_id = $rows['food_item_id'];
                            $quantity = $rows['quantity'];
        

                            $inner_sql = "SELECT title, price FROM tbl_menu WHERE id = $food_item_id ";
                            $inner_res = mysqli_query($conn, $inner_sql);

                            if (mysqli_num_rows($inner_res) == 1) {
                                $inner_row = mysqli_fetch_assoc($inner_res);
                                $food_item = $inner_row['title'];
                                $unit_price = $inner_row['price'];

                                $total_price = $quantity * $unit_price;

                                $grand_total_price += (float)$total_price;
                            }


                ?>

                            <tr>
                                <td> <?php echo $sn++ ?> </td>
                                <td style="text-align: left;"> <?php echo $food_item ?> </td>
                                <td> <?php echo "Rs. " . number_format($unit_price, 2) ?></td>
                                <td> <?php echo $quantity ?></td>
                                <td> <?php echo "Rs. " . number_format($total_price, 2); ?> </td>
                            </tr>

                <?php
                        }
                        $grand_total_price = round($grand_total_price, 2);
                        $_SESSION['total-price'] = $grand_total_price;
                    }
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="grand-total-row">Grand-total:</td>
                    <td class="grand-total-row"> <?php echo "Rs. " . number_format($grand_total_price, 2) ?> </td>
                </tr>


            </table>
            <div>

                <div class="payment-method-box">
                    <div style="text-align: center; font-size: 18px;"> Choose a payment method: </div>
                    <form action="<?php echo SITEURL. "admin/process-order.php" ?>"  method="post">

                        <input type="hidden" name="form-id" value="confirm-order-form">
                        <input type="hidden" name="order-id" id="order-id">
                        <input type="hidden" name="delivery-location" id="delivery-location">
                        <div class="payment-method">
                            <input type="radio" name="payment-method" id="khalti" value="khalti" required><label for="khalti" class="label-khalti"> <img src="../images/khalti-logo.svg" style="width:90%;"> </label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" name="payment-method" id="cod" value="cod"><label for="cod" class="label-cod" style="padding:8%;">Cash On Delivery (COD) </label>

                        </div>
                        <div class="clear-fix"></div>
                        <div>
                            <button type="submit" name="submit" class="confirm-button" id="confirm-order">Confirm and Place Order</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

</div>


<?php include("../partials/footer.php"); ?>

<script src ="../javascript/submit-order-form.js"></script>