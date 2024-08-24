
<?php
include("../config/constants.php");

if (isset($_POST['submit']) && $_POST['form-id'] === 'update-admin-form') {

    $full_name = $_POST['full-name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re-password'];

    if ($password === $re_password) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE  tbl_admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$hashed_password'
        WHERE id = 1
        ";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['notification_msg'] = "Admin Updated Successfully.";
        } else {
            $_SESSION['notification_msg'] = "Something went wrong!";
        }
    } else {
        $_SESSION['notification_msg'] = "Confirmation passwords didn't match!";
    }
    header("Location:" . SITEURL . "admin/index.php");
} else {

    $_SESSION['notification_msg'] = "Something went wrong!";
    header("Location:" . SITEURL . "admin/index.php");
}
?>