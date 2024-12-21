<?php
include("../config/constants.php");

if (isset($_POST['submit']) && $_POST['form_id'] === 'update-category-form') {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $existing_image = $_POST['existing-image'];


    // check whether the update image input fied is empty or not
    if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] !== "") {

        // handle the new image:
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

            // delete the existing image from the /image/categories folder:
            $path = "../images/categories/" . $existing_image;
            $remove = unlink($path);

            // providing the unique name to the image file

            $image_extension = end(explode(".", $image_name)); //gets image extension

            $image_name = "food-category-" . $title . uniqid(mt_rand(0, 99999)) . "." . $image_extension;

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
    } else {
        $image_name = $existing_image;
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

    // insert the data into the database:
    $sql = "UPDATE  tbl_category SET
    title = '$title',
    image_name = '$image_name',
    featured = '$featured',
    available = '$available'
    WHERE id = '$id'
    ";

    // Execute query and save the data in the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == true) {
        $_SESSION['notification_msg'] = "Category updated successfully!";
    } else {
        $_SESSION['notification_msg'] = "Something went wrong!";
    }
    header("Location:" . SITEURL . 'admin/manage-categories.php');
    exit();
} else {
    header("Location:" . SITEURL . 'admin/manage-categories.php');
}

?>
