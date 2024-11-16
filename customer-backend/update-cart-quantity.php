<?php 
include("../config/constants.php");

if($_POST['form-id'] === 'update-cart-quantity-form'){
 
    $user_id = $_POST['user-id'];
    $food_item_id = $_POST['food-item-id'];
    $quantity = $_POST['quantity'];
    $redirect_uri = $_POST['redirect-uri'];

    echo "    food-item-id=" .$food_item_id;
    echo "    user-id". $user_id;
    echo "    quantity=". $quantity;
    echo "    redirect uri= ". $redirect_uri;

      //get the unit price of the food-item
      $get_price_query = "SELECT price FROM tbl_menu WHERE id = $food_item_id ";
      $get_price_result = mysqli_query($conn, $get_price_query);

      if(mysqli_num_rows($get_price_result) == 1){
          $row = mysqli_fetch_assoc($get_price_result);
          $unit_price = $row['price'];
          $total_price = $unit_price * $quantity;
      }

    $sql = "UPDATE  tbl_cart SET
        quantity = $quantity,
        total_price = $total_price
        WHERE user_id = $user_id AND food_item_id = $food_item_id;
        ";

    $res = mysqli_query($conn, $sql);

    if($res == true){
        header("Location:".$redirect_uri);
        exit;

    }
    else{
        $_SESSION['notification-msg']="Something went wrong!";
        header("Location:".$redirect_uri);
        exit;

    }

}
else{
    header("Location:".SITEURL."index.php");

}


?>