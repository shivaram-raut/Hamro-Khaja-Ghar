
<?php
include("../config/constants.php");

if ($_POST['form-id'] === 'customer-account-status') {
    $user_id = $_POST['user-id'];
    $status = $_POST['status'];

    if($status == 'activated'){
        $sql = "UPDATE  tbl_customer SET
        account_status = 'deactivated'
        WHERE id = $user_id;
        ";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['notification_msg'] = "Customer Account Deactivated Successfully.";
        } else {
            $_SESSION['notification_msg'] = "Something went wrong!";
        }
    } elseif($status == 'deactivated'){
        $sql = "UPDATE  tbl_customer SET
        account_status = 'activated'
        WHERE id = $user_id;
        ";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['notification_msg'] = "Customer Account Activated Successfully.";
        } else {
            $_SESSION['notification_msg'] = "Something went wrong!";
        }
    }
        header("Location:" . SITEURL . "admin/manage-customers.php");
} else {
    $_SESSION['notification_msg'] = "Something went wrong!";
    header("Location:" . SITEURL . "admin/index.php");
}
?>