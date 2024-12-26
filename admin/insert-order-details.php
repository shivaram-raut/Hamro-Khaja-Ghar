<?php 
function insertOrderDetails($order_id, $user_id) {
    global $conn;

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
    }
}
?>
