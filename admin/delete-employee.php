<?php
include("../config/constants.php");
// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form_id'] == 'delete-employee-form') {

    $id = $_POST['id'];

    $sql = "DELETE FROM tbl_employee WHERE id = $id ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if($res == true)
    {
        $_SESSION['notification_msg'] = "Employee Deleted Successfully!";
         header("Location:" . SITEURL . 'admin/manage-employees.php');
         exit();
    }

}
else{
        $_SESSION['notification_msg'] = "Something went wrong!";
         header("Location:" . SITEURL . 'admin/manage-employees.php');
}
?>