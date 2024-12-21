<?php 
include("../config/constants.php");

if($_POST['form-id'] == 'delete-order-history'){
 
    $order_id = $_POST['order-id'];
    $visible = "no";
    
    $sql = "UPDATE  tbl_order_history SET
        visible = '$visible'
        WHERE order_id = '$order_id' ;
        ";

    $res = mysqli_query($conn, $sql);

    if($res == true){
        $_SESSION['notification_msg'] = "Order History Deleted Successfully.";
       header("Location:".SITEURL."main/order-page.php");
        exit;
    }
  
}
else{
    header("Location:".SITEURL."index.php");
}
?>