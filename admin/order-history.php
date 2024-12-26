<?php include("../partials/admin-navigation-bar.php"); ?>

<form id="order-details-form" action="order-details.php" method="POST" style="display: none;">
    <input type="hidden" name="form-id" value="order-details-form">
    <input type="hidden" name="user-id" id="user-id">
    <input type="hidden" name="order-id" id="order-id">
    <input type="hidden" name="delivery-adrs" id="delivery-adrs">
    <input type="hidden" name="order-status" id="order-status">
    <input type="hidden" name="payment-method" id="payment-method">
    <input type="hidden" name="order-date" id="order-date">
    <input type="hidden" name="mode" value="view-only">
</form>

<!-- delete-order-history form starts here -->
<div class="overlay"></div>
<div class="form delete-form" style="width: 35%;">
    <span class="cross">&times;</span>
    <br>
    <div class="form-heading">Delete Order History</div>
    <div class="confirm-delete-qsn">Delete the order history permanently?</div>
    <form action="<?php echo SITEURL .  'admin/delete-order-history.php' ?> " method="post">
        <input type="hidden" name="form-id" value="delete-order-history" />
        <input type="hidden" name="order-id" id="delete-order-id" />

        <input type="submit" name="submit" value="Delete" class=" submit-button delete-yes" />
        <span class="cross submit-button delete-no " style="font-size: 18px; padding: 10px;"> Cancel</span>
        <div class="clear-fix"></div>
    </form>
</div>
<!-- delete-order-history form stops here! -->

<div class="container" style="width: 90%; min-height: 65vh;">

    <div class="page-heading">
        <h2> Order History:</h2>
    </div>

    <!-- Filter Buttons -->
    <form action="" method="GET">
        <button type="submit" name="filter" id="filter-this-month" value="this-month" class="filter-button">This Month</button>
        <button type="submit" name="filter" id="filter-this-week" value="this-week" class="filter-button">This Week</button>
        <button type="submit" name="filter" id="filter-today" value="today" class="filter-button">Today</button>
        <button type="submit" name="filter" id="filter-all" value="" class="filter-button">All Orders</button>
    </form>
    <div class="clear-fix"></div>

    <div class="order-table">
        <table class="table-full">
            <tr>
                <th>S.N.</th>
                <th>Order-id</th>
                <th>Time </th>
                <th>Total Price</th>
                <th> Payment </th>
                <th> Order Status </th>
                <th>Actions</th>
            </tr>

            <!-- Accessing the order-history -->
            <?php
            // Get the current filter
            $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

            // Determine date range based on filter
            $current_date = date('Y-m-d');
            if ($filter === 'today') {
                echo "
                <script> 
                document.getElementById('filter-today').classList.add('filter-active');
                </script>";
                $start_date = $current_date;
                $end_date = $current_date;
            } elseif ($filter === 'this-week') {
                echo "
                <script> 
                document.getElementById('filter-this-week').classList.add('filter-active');
                </script>";
                $start_date = date('Y-m-d', strtotime('monday this week'));
                $end_date = date('Y-m-d', strtotime('sunday this week'));
            } elseif ($filter === 'this-month') {
                echo "
                <script> 
                document.getElementById('filter-this-month').classList.add('filter-active');
                </script>";
                $start_date = date('Y-m-01'); // First day of the month
                $end_date = date('Y-m-t'); // Last day of the month
            } else {
                echo "
                <script> 
                document.getElementById('filter-all').classList.add('filter-active');
                </script>";
                $start_date = null;
                $end_date = null;
            }

            // Build the SQL query
            $sql = "SELECT * FROM tbl_order_history";
            if ($start_date && $end_date) {
                $sql .= " WHERE DATE(date) BETWEEN '$start_date' AND '$end_date'";
            }
            $sql .= " ORDER BY id DESC";

            $res = mysqli_query($conn, $sql);
            $sn = 1;

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $grand_total_price = 0;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $order_id = $rows['order_id'];
                        $user_id = $rows['user_id'];
                        $delivery_adrs = $rows['delivery_adrs'];
                        $price = $rows['total_price'];
                        $payment_method = $rows['payment_method'];
                        $status = $rows['order_status'];
                        $date = $rows['date'];

                        $grand_total_price += (float)$price;
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $order_id; ?></td>
                            <td><?php echo date('Y-m-d h:i:s A', strtotime($date)); ?></td>
                            <td><?php echo "Rs. " . number_format($price, 2); ?></td>
                            <td><?php echo $payment_method; ?></td>

                            <td>
                                <div>
                                    <?php if ($status == "Ordered") : ?>
                                        <span style="color:forestgreen"> <?php echo $status; ?></span>
                                    <?php else : ?>
                                        <span style="color:deepskyblue"> <?php echo $status; ?></span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td style="text-align: left;">
                                <div>
                                    <span class="view-details-btn" style=" color: #008fb3;cursor: pointer;margin-right: 10%;" data-user-id="<?php echo $user_id; ?>" data-order-id="<?php echo $order_id; ?>" data-delivery-adrs="<?php echo $delivery_adrs; ?>" data-order-status="<?php echo $status; ?>" data-payment-method="<?php echo $payment_method; ?>" data-order-date="<?php echo $date; ?>"> &#128065;View Details</span>
                                    <span class="delete-odr-btn" style=" color: red;cursor: pointer;" data-order-id="<?php echo $order_id; ?>"> &#128465;Delete</span>
                                </div>
                            </td>
                        </tr>
            <?php
                    }
                } 
            }
            ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td></td>
                <td class="grand-total-row">Grand-total:</td>
                <td class="grand-total-row" style="padding:1%;"> <?php echo "Rs. " . number_format($grand_total_price, 2) ?> </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

    </div>
</div>

<?php include("../partials/admin-footer.php"); ?>
<script src="../javascript/order-details-form.js"> </script>
<script src="../javascript/delete-order.js"> </script>