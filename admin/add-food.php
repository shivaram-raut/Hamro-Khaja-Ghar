
<?php
include("../config/constants.php");

// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form_id'] === 'add-food-form') {

    // Get data from the add-category form
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];

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

            $image_name = "menu-" . $title .  uniqid(mt_rand(0, 99999)) . "." . $image_extension;

            $destination_path = "../images/menu/" . $image_name;

            //upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload === false) {
                $_SESSION['notification_msg'] = "Image upload failed";
                header("Location:" . SITEURL . 'admin/manage-menu.php');
                exit();
            }
        } else {
            $_SESSION['notification_msg'] = "Invalid image file!";
            header("Location:" . SITEURL . 'admin/manage-menu.php');
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
 

    // Prepare the SQL statement using placeholders
$stmt = $conn->prepare("INSERT INTO tbl_menu (title, price, food_description, image_name, category, featured, available) 
VALUES (?, ?, ?, ?, ?, ?, ?)");

// Check if the statement was prepared successfully
if ($stmt === false) {
die('Prepare failed: ' . htmlspecialchars($conn->error));
}

 
$stmt->bind_param("sdssiss", $title, $price, $description, $image_name, $category_id, $featured, $available);

// Execute the prepared statement
if ($stmt->execute()) {
$_SESSION['notification_msg'] = "Food added successfully!";
} else {
$_SESSION['notification_msg'] = "Something went wrong!";
}

// Close the prepared statement
$stmt->close();

// Redirect to the manage menu page
header("Location: " . SITEURL . 'admin/manage-menu.php');
exit();

} else {
    header("Location:" . SITEURL . 'admin/manage-menu.php');
}
?>
