<?php
include("../config/constants.php");
include("insert-order-details.php");

if (isset($_POST['submit']) && $_POST['form-id'] == "confirm-order-form") {

    $user_id = $_SESSION['user-id'];

    $order_id = $_POST['order-id'];

    $delivery_adrs = $_POST['delivery-location'];

    $total_price = $_SESSION['total-price'];

    $payment_method = $_POST['payment-method'];

    $order_status = "Ordered";

    // check account status before processing the order.

    $sql = "SELECT * FROM tbl_customer WHERE id=$user_id";

    $res = mysqli_query($conn, $sql);

    if($res == true){
        if(mysqli_num_rows($res) == 1){
            $row= mysqli_fetch_assoc($res);
            $full_name = $row['full_name'] ;
            $email = $row['email'];
            $phone = $row['mobile_number'];
            $account_status = $row['account_status'];
        }

        if($account_status == 'deactivated'){
            $_SESSION['notification_msg']="Dear Customer, your account has been deactivated. You can't make any orders.";
            header("Location:". SITEURL."main/index.php");
            exit();
        }
    }
    // handling the khalti payment cases:

    if ($payment_method === 'khalti') {
        $_SESSION['order-id'] = $order_id;

        $_SESSION['customer-name'] = $full_name;

        $_SESSION['delivery-adrs'] = $delivery_adrs;


        include("../khalti-payment-gateway/payment-request.php");
    } else {
        // Process for other payment methods
        $sql = "INSERT INTO tbl_order (order_id, user_id, customer_name, total_price, delivery_adrs, payment_method, order_status)  VALUES ('$order_id', $user_id, '$full_name', $total_price, '$delivery_adrs', '$payment_method', '$order_status')";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($res == true) {
            // Insert order details into order table:
            insertOrderDetails($order_id, $user_id);

            // clear cart:
            $sql_delete = "DELETE FROM tbl_cart WHERE user_id = $user_id ";

            $res_delete = mysqli_query($conn, $sql_delete);

            if ($res_delete == true) {
                $_SESSION['notification_msg'] = "Your order has been successfullly placed.";
                header("Location:" . SITEURL . "main/index.php");
            }
        }
    }
}
