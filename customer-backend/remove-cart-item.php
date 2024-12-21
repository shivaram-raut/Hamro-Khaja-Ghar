<?php 
include("../config/constants.php");

if($_POST['form-id'] === 'remove-cart-item-form'){

    $user_id = $_POST['user-id'];
    $food_item_id = $_POST['food-item-id'];
    $redirect_uri = $_POST['redirect-uri'];

    $sql = "DELETE FROM tbl_cart WHERE user_id = $user_id AND food_item_id = $food_item_id; " ;

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