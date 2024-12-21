<?php
include("../config/constants.php");


if ($_POST['form-id'] == "update-status-form") {

    $order_id = $_POST['order-id'];
    $status_value = $_POST['order-status'];


    if ($status_value == "Delivered") {
        $sql_get_data = "SELECT * FROM tbl_order WHERE order_id = '$order_id' ";
        $res_get_data = mysqli_query($conn, $sql_get_data);

        if ($res_get_data == true) {
            $row = mysqli_fetch_assoc($res_get_data);

            $ordr_id = $row['order_id'];
            $user_id = $row['user_id'];
            $customer_name = $row['customer_name'];
            $total_price = $row['total_price'];
            $delivery_adrs = $row['delivery_adrs'];
            $payment_method = $row['payment_method'];
            $order_status = "Delivered";
            $visible ="yes";

            $sql_insert_data = "INSERT INTO tbl_order_history (order_id, user_id, customer_name, total_price, delivery_adrs, payment_method, order_status,visible)
            VALUES('$order_id', $user_id, '$customer_name', $total_price, '$delivery_adrs', '$payment_method', '$order_status', '$visible') ";

            $res_insert_data = mysqli_query($conn, $sql_insert_data);

            if ($res_insert_data == true) {
                $sql_delete_data = "DELETE FROM tbl_order WHERE order_id = '$order_id' ";

                $res_delete_data = mysqli_query($conn, $sql_delete_data);
            }
        }
        header("Location:" . SITEURL . "admin/order-table.php");
    } else {
        $sql = "UPDATE tbl_order SET
        order_status = '$status_value' 
        WHERE order_id = '$order_id' ";

        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            header("Location:" . SITEURL . "admin/order-details.php");
        }
    }
} else {
    header("Location:" . SITEURL . "admin/order-table.php");
}
?>