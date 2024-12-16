
<?php
include("../config/constants.php");

if ($_POST['form-id'] === 'employee-account-status') {
    $username = $_POST['username'];
    $status = $_POST['status'];

    if($status == 'activated'){
        $sql = "UPDATE  tbl_employee SET
        account_status = 'deactivated'
        WHERE username = '$username';
        ";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['notification_msg'] = "Employee Account Deactivated Successfully.";
        } else {
            $_SESSION['notification_msg'] = "Something went wrong!";
        }
    } elseif($status == 'deactivated'){
        $sql = "UPDATE  tbl_employee SET
        account_status = 'activated'
        WHERE username= '$username';
        ";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['notification_msg'] = "Employee Account Activated Successfully.";
        } else {
            $_SESSION['notification_msg'] = "Something went wrong!";
        }
    }
        header("Location:" . SITEURL . "admin/manage-employees.php");
} else {
    $_SESSION['notification_msg'] = "Something went wrong!";
    header("Location:" . SITEURL . "admin/dashboard.php");
}
?>