<?php
if (!isset($_POST['form-id'])) {
    include("../config/constants.php");
    header("Location: " . SITEURL . 'main/order-page.php');
    exit();
}
include("../partials/navigation-bar.php");


if ( isset($_POST['form-id']) && $_POST['form-id'] == "order-details-form") {
    $user_id = $_POST['user-id'];
    $order_id = $_POST['order-id'];
    $delivery_adrs = $_POST['delivery-adrs'];
    $order_status = $_POST['order-status'];
    $date = $_POST['order-date'];

    $sql = "SELECT * FROM tbl_customer WHERE id = $user_id ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $row = mysqli_fetch_assoc($res);
        if ($row == true) {
            $full_name = $row['full_name'];
            $mobile_number = $row['mobile_number'];
        }
    }

?>
    <form action="<?php echo SITEURL. 'partials/generate-invoice.php'; ?>" method="post" id="generate-invoice-form" style="display: none;">
        <input type="hidden" name="form-id" value="generate-invoice-form">
        <input type="hidden" name="full-name" value="<?php echo $full_name; ?>">
        <input type="hidden" name="mobile-number" value="<?php echo $mobile_number; ?>">
        <input type="hidden" name="delivery-adrs" value="<?php echo $delivery_adrs; ?>">
        <input type="hidden" name="order-id" value="<?php echo $order_id; ?>">
        <input type="hidden" name="order-date" value="<?php echo $date; ?>" >
    </form>

    <div class="container" style=" width: 90%; padding:5px 3%;">
    <div class="page-heading">
            <h2> Order ID: <?php echo $order_id; ?> </h2>
        </div>

        <div class="order-details-grid-container">
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
                        <label for="address">Delivery Location</label>
                        <textarea id="address" name="address" rows="2" cols="40" disabled><?php echo $delivery_adrs ?> </textarea>
                    </div>
                </div>

            </div>

            <div class="order-details">

                <div class="header">Order Details:</div>

                <table class="order-table">
                    <tr>
                        <th>S.N.</th>
                        <th> Items </th>
                        <th> Price </th>
                        <th> Quantity</th>
                        <th> Total Price </th>
                    </tr>

                    <?php
                    $grand_total_price = 0.0;
                    $sql = "SELECT * FROM tbl_order_details WHERE order_id = '$order_id' ";
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);

                        if ($count == 1) {
                            $row = mysqli_fetch_assoc($res);
                            $item_id_list_json = $row['item_id_list'];
                            $quantity_list_json = $row['quantity_list'];
                            $unit_price_list_json = $row['unit_price_list'];

                            $item_id_list = json_decode($item_id_list_json);
                            $quantity_list = json_decode($quantity_list_json);
                            $unit_price_list = json_decode($unit_price_list_json);

                            $length = count($item_id_list);

                            $sn = 1;
                            while ($length > 0) {
                                $length -= 1;

                                $unit_price = array_pop($unit_price_list);
                                $quantity = array_pop($quantity_list);

                                $total_price = $quantity * $unit_price;

                                $grand_total_price += (float)$total_price;

                                $food_item_id = array_pop($item_id_list);

                                $inner_sql = "SELECT title FROM tbl_menu WHERE id = $food_item_id ";
                                $inner_res = mysqli_query($conn, $inner_sql);

                                if (mysqli_num_rows($inner_res) == 1) {
                                    $inner_row = mysqli_fetch_assoc($inner_res);
                                    $food_item = $inner_row['title'];
                                    // $unit_price = $inner_row['price'];

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
                    <div style="padding: 5% 1%;">
                            <input type="hidden" name="form-id" value="update-status-form">
                            <input type="hidden" name="order-id" value="<?php echo $order_id; ?>">
                            <label for="order-status" style="font-size: 17px; margin: 5px;">Order Status:</label>
                            <select id="order-status" name="order-status" style="font-size: 17px; text-align: center; padding: 5px;" disabled>
                                <option value="Ordered" <?php echo ($order_status == 'Ordered') ? 'selected' : ''; ?>>Ordered</option>
                                <option value="On-process" <?php echo ($order_status == 'On-process') ? 'selected' : ''; ?>>On-process</option>
                                <option value="On-delivery" <?php echo ($order_status == 'On-delivery') ? 'selected' : ''; ?>>On-delivery</option>
                                <option value="Delivered" <?php echo ($order_status == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                            </select>
                        </form>

                        <div style="margin: 0 50px;">
                            <div class="button" id="print-invoice-btn" style="float:left">&#x1F5B6; Print Invoice</div>
                            <div class="button" id="go-back-btn" style="float:right">&#x21A9; Go Back</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>


<?php
    include("../partials/footer.php");
}  
?>

<script src="../javascript/order-details-page.js"></script>