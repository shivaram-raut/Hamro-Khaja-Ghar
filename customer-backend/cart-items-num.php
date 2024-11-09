<?php 
include("../config/constants.php");

$user_id = $_SESSION['user-id'];
$total_items = 0;

$sql = " SELECT COUNT(*) AS total_items FROM tbl_cart WHERE user_id = $user_id ";

$res = mysqli_query($conn, $sql);

if($res == true){
    $row = mysqli_fetch_assoc($res);

    $total_items = $row['total_items'] ?? 0;

}

echo $total_items;
exit;

?>