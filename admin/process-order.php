<?php
include("../config/constants.php");

if (isset($_POST['submit']) && $_POST['form-id'] == "confirm-order-form") {

    $user_id = $_SESSION['user-id'];

    $order_id = $_POST['order-id'];

    $delivery_adrs = $_POST['delivery-location'];

    $total_price = $_SESSION['total-price'];

    $full_name = $_SESSION['full-name'];

    $payment_method = $_POST['payment-method'];

    $order_status = "Ordered";

    $sql = "INSERT INTO tbl_order (order_id, user_id,customer_name, total_price, delivery_adrs, payment_method, order_status)  VALUES ('$order_id', $user_id, '$full_name', $total_price, '$delivery_adrs', '$payment_method', '$order_status')";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == true) {

        $item_id_list = [];
        $quantity_list = [];
        $unit_price_list = [];
        $sql_get_items = "SELECT * FROM tbl_cart WHERE user_id = $user_id ";

        $res_get_items = mysqli_query($conn, $sql_get_items);

        if ($res_get_items == true) {

            while ($rows = mysqli_fetch_assoc($res_get_items)) {

                $item_id_list[] = $rows['food_item_id'];
                $quantity_list[] = $rows['quantity'];
                $unit_price_list[] = $rows['unit_price'];
            }

            $item_id_list_json = json_encode($item_id_list);
            $quantity_list_json = json_encode($quantity_list);
            $unit_price_list_json = json_encode($unit_price_list);

            $sql_insert_order = "INSERT INTO tbl_order_details (order_id, item_id_list, quantity_list, unit_price_list) 
        VALUES ('$order_id', '$item_id_list_json', '$quantity_list_json', '$unit_price_list_json' )";


            $res_insert_order = mysqli_query($conn, $sql_insert_order);

            if ($res_insert_order == true) {

                // delete the items from the tbl_cart

                $sql_delete = "DELETE FROM tbl_cart WHERE user_id = $user_id ";

                $res_delete = mysqli_query($conn, $sql_delete);

                if ($res_delete == true) {
                    $_SESSION['notification_msg'] = "Your order has been successfullly placed.";
                    header("Location:" . SITEURL . "main/index.php");
                }
            }
        }
    }
}
?>
