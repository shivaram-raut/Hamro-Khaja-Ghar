<?php 
include("../config/constants.php");

if($_POST['form-id'] == 'delete-order-history'){
 
    $order_id = $_POST['order-id'];
   
    $sql = "DELETE FROM   tbl_order_history WHERE order_id = '$order_id';";

    $res = mysqli_query($conn, $sql);

    if($res == true){
        $_SESSION['notification_msg']="Order History Deleted Successfully.";
       header("Location:".SITEURL."admin/order-history.php");
        exit;
    }
  
}
else{
    header("Location:".SITEURL."admin/dashboard.php");

}

?>