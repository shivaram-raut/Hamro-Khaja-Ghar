<?php include("../partials/admin-navigation-bar.php"); ?>

<form id="order-details-form" action="order-details.php" method="POST" style="display: none;">
    <input type="hidden" name="form-id" value="order-details-form">
    <input type="hidden" name="user-id" id="user-id">
    <input type="hidden" name="order-id" id="order-id">
    <input type="hidden" name="delivery-adrs" id="delivery-adrs">
    <input type="hidden" name="order-status" id="order-status">
    <input type="hidden" name = "order-date" id="order-date">
</form>

<section class="main-content">
    <div class="container" style="width: 90%;">

        <div class="page-heading">
            <h1> Manage Orders</h1>
        </div>

        <div class="items-list-table">
            <table class="table-full">
                <tr>
                    <th>S.N.</th>
                    <th>Order-id</th>
                    <th>Customer Name</th>
                    <th>Total Price</th>
                    <th>Time </th>
                    <th> Order Status </th>
                    <th>Actions</th>
                </tr>

                <?php
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC ";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $order_id = $rows['order_id'];
                            $user_id = $rows['user_id'];
                            $customer_name = $rows['customer_name'];
                            $delivery_adrs = $rows['delivery_adrs'];
                            $price = $rows['total_price'];
                            $status = $rows['order_status'];
                            $date = $rows['date'];

                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $order_id; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo "Rs. " .number_format($price, 2); ?></td>
                                <td><?php echo date('Y-m-d h:i:s A', strtotime($date)); ?></td>

                                <td>
                                    <div>
                                        <?php if($status == "Ordered") : ?>
                                        <span style="color:#28a745"> <?php echo $status; ?></span>
                                        <?php elseif($status=="On-process"): ?>
                                        <span style="color:#008080"> <?php echo $status; ?></span>
                                        <?php elseif($status=="On-delivery"): ?>
                                            <span style="color: #007bff"> <?php echo $status; ?></span>
                                         <?php endif; ?>  


                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <span class="view-details-btn" style=" color: #008fb3;cursor: pointer;margin-right: 10%;" data-user-id="<?php echo $user_id; ?>" data-order-id = "<?php echo $order_id; ?>" data-delivery-adrs = "<?php echo $delivery_adrs; ?>" data-order-status = "<?php echo $status; ?>" data-order-date = "<?php echo $date; ?>" >  &#128065;View Details</span>

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


<?php include("../partials/admin-footer.php"); ?>

<script src="../javascript/order-details-form.js"> </script>