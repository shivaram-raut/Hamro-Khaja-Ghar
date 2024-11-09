<?php
include("../config/constants.php");

// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form-id'] === 'cart-popup-form') {

    // Get data from the cart-pop-up form
    $user_id = $_POST['user-id'];
    $food_item_id = $_POST['food-item-id'];
    $item_quantity = $_POST['item-quantity'];
    $redirect_uri = $_POST['redirect-uri'];
    $total_price = 0;

     // truncating the query string parts of the $redirect_uri if there is any:
        $parsed_url = parse_url($redirect_uri);

        if (isset($parsed_url['query'])) {
            
            $new_redirect_uri = '';
    
            if (isset($parsed_url['scheme'])) {
                $new_redirect_uri .= $parsed_url['scheme'] . '://';
            }
    
            if (isset($parsed_url['host'])) {
                $new_redirect_uri .= $parsed_url['host'];
            }
    
            if (isset($parsed_url['path'])) {
                echo "there is path, parsed path: ".$parsed_url['path'];
                if($parsed_url['path'] == "/hamro-khaja-ghar/main/food-menu.php"){
                    $new_redirect_uri = $redirect_uri;
                }
                else{
                    $new_redirect_uri .= $parsed_url['path'];
                }
            }
    
            // Set the final redirect URI without query parameters
            $redirect_uri = $new_redirect_uri;
        }


    //check if the food-item already exists in the cart table
    $check_food_exist = "SELECT food_item_id FROM tbl_cart WHERE user_id = $user_id AND food_item_id = $food_item_id ";
    $food_exist_result = mysqli_query($conn, $check_food_exist);

    if(mysqli_num_rows($food_exist_result) == 1){
        $_SESSION['notification_msg']= "This food-item already exists in your cart!";
        header("Location:".$redirect_uri);


    }
    else{
        //get the unit price of the food-item
        $get_price_query = "SELECT price FROM tbl_menu WHERE id = $food_item_id ";
        $get_price_result = mysqli_query($conn, $get_price_query);

        if(mysqli_num_rows($get_price_result) == 1){
            $row = mysqli_fetch_assoc($get_price_result);
            $unit_price = $row['price'];
            $total_price = $unit_price * $item_quantity;
        }

        //insert the food-item into the cart table
        $insert_query = "INSERT INTO tbl_cart SET
        user_id = $user_id,
        food_item_id = $food_item_id,
        quantity = $item_quantity,
        total_price = $total_price
        ";

        $insert_query_result = mysqli_query($conn, $insert_query);

        if($insert_query_result == true){
            header("Location:".$redirect_uri);
        }

    }

}
else{
    header("Location:" . SITEURL . "index.php");
}