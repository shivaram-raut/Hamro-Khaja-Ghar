<?php
include("../config/constants.php");
// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form_id'] == 'delete-category-form') {

    $id = $_POST['id'];
    $image = $_POST['image'];


    // remove the image from the image/categories folder:

    $path = "../images/categories/" . $image;
    $remove = unlink($path);

    if ($remove == true) {

        // delte the category from the database:
        $sql = "DELETE FROM tbl_category WHERE id = '$id' && image_name = '$image' ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($res == true) {
            $_SESSION['notification_msg'] = "Category Deleted Successfully!";
            header("Location:" . SITEURL . 'admin/manage-categories.php');
            exit();
        }
    }
} else {
    $_SESSION['notification_msg'] = "Something went wrong!";
    header("Location:" . SITEURL . 'admin/manage-categories.php');
}

?>
