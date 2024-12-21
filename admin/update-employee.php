
<?php
include("../config/constants.php");

function checkUsername($new_username, $existing_username, $conn)
{
    // check if username has been changed and if new username already exists redirect to manage-employees page
    if ($new_username != $existing_username) {

        // Check if the username already exists
        $check_username = "SELECT * FROM tbl_employee WHERE username = '$new_username'";
        $check_res = mysqli_query($conn, $check_username);

        if (mysqli_num_rows($check_res) > 0) {
            // Username already exists
            $_SESSION['notification_msg'] = "Username already exists. Please choose a different one.";

            // Redirect back to the manage-employees page
            header("Location:" . SITEURL . 'admin/manage-employees.php');
            exit;
        }
    }
}

// setting the msg variables
$success_msg = "Employee updated successfully!";
$failure_msg = "Something went wrong";
$password_mismatch_msg = "Confirmation password didn't match";

// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form_id'] === 'update-employee-form') {

    // Get data from the update-employee form
    $full_name = $_POST['full_name'];
    $new_username = $_POST['username'];
    $existing_username = $_POST['existing-username'];
    $id = $_POST['id'];

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];

        // check if username has been changed
        checkUsername($new_username, $existing_username, $conn);

        if ($password === $re_password) {

            // Encrypt the password using bcrypt
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE tbl_employee SET
                full_name = '$full_name',
                username = '$new_username',
                password = '$hashed_password'
                WHERE id = '$id'
                ";
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if ($res === true) {
                $_SESSION['notification_msg'] = $success_msg;
            } else {
                $_SESSION['notification_msg'] = $failure_msg;
            }
        } else {
            $_SESSION['notification_msg'] = $password_mismatch_msg;
        }
    } else {

        // check if username has been changed
        checkUsername($new_username, $existing_username, $conn);

        $sql = "UPDATE tbl_employee SET
                full_name = '$full_name',
                username = '$new_username'
                WHERE id = $id;
                ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($res === true) {
            $_SESSION['notification_msg'] = $success_msg;
        } else {
            $_SESSION['notification_msg'] = $failure_msg;
        }
    }
    // Redirect back to the manage-employees page
    header("Location:" . SITEURL . 'admin/manage-employees.php');
    exit;
} else {

    $_SESSION['notification_msg'] = $failure_msg;

    // Redirect back to the manage-employees page
    header("Location:" . SITEURL . 'admin/manage-employees.php');
    exit;
}
?>
