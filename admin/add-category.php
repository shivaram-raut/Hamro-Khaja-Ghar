
<?php
include("../config/constants.php");

// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form_id'] === 'add-category-form') {

    // Get data from the add-category form

    $title = $_POST['title'];

    if (isset($_FILES["image"]["name"])) {

        $image_name = $_FILES["image"]["name"];
        $source_path = $_FILES["image"]["tmp_name"];

        // check whether the uploaded file is image or not
        $check = getimagesize($source_path);
        if ($check !== false) {
            
            // check the size of the image file, 5000000bytes = 5MB
            if ($_FILES["image"]["size"] > 5000000) {
                $_SESSION['notification_msg'] = "Upload an image smaller than 5 MB!";
                header("Location:" . SITEURL . 'admin/manage-categories.php');
                exit();
            }

            // providing the unique name to the image file

            $image_extension_array = explode(".", $image_name);
            $image_extension = end($image_extension_array); //gets image extension

            $image_name = "food-category-" .$title.  uniqid(mt_rand(0, 99999)) . "." . $image_extension;

            $destination_path = "../images/categories/" . $image_name;

            //upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload === false) {
                $_SESSION['notification_msg'] = "Image upload failed";
                header("Location:" . SITEURL . 'admin/manage-categories.php');
                exit();
            }
        } else {
            $_SESSION['notification_msg'] = "Invalid image file!";
            header("Location:" . SITEURL . 'admin/manage-categories.php');
            exit();
        }
    }

    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }

    if (isset($_POST['available'])) {
        $available = $_POST['available'];
    } else {
        $available = "No";
    }

    $sql = "INSERT INTO tbl_category SET
                title = '$title',
                featured = '$featured',
                image_name = '$image_name',
                available = '$available'
                ";

    // Execute query and save the data in the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == true) {
        $_SESSION['notification_msg'] = "Category added successfully!";
    } else {
        $_SESSION['notification_msg'] = "Something went wrong!";
    }
    header("Location:" . SITEURL . 'admin/manage-categories.php');
    exit();
} else {
    header("Location:" . SITEURL . 'admin/manage-categories.php');
}
?>
