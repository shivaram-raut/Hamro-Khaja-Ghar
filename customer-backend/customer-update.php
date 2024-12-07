
<?php
include("../config/constants.php");

function checkEmail($new_email, $existing_email, $conn)
{
    // check if username has been changed and if new username already exists redirect to manage-employees page
    if ($new_email != $existing_email) {

        // Check if the username already exists
        $check_email = "SELECT email FROM tbl_customer WHERE email = '$new_email'";
        $check_res = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($check_res) > 0) {
            // Username already exists
            $_SESSION['notification_msg'] = "There is already another account registered with this email id.";

            // Redirect back to the manage-employees page
            header("Location:" . SITEURL . 'main/update-customer.php');
            exit;
        }
    }
}


// setting the msg variables
$success_msg = "Account updated successfully!";
$failure_msg = "Something went wrong";

// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form-id'] === 'update-customer-form') {

    // Get data from the update-customer form
    $user_id = $_POST['user-id'];
    $full_name = htmlspecialchars(trim($_POST['full-name']), ENT_QUOTES, 'UTF-8');
    $adrs = htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8');
    $mobile_number = $_POST['mobile-number'];
    $new_email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
    $existing_email = htmlspecialchars(trim($_POST['existing-email']), ENT_QUOTES, 'UTF-8');



    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $re_password = $_POST['re-password'];

        // check if new email already exists
        checkEmail($new_email, $existing_email, $conn);



        if ($password === $re_password) {

            // Encrypt the password using bcrypt
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE tbl_customer SET
                full_name = '$full_name',
                address = '$adrs',
                mobile_number=$mobile_number,
                email = '$new_email',
                password = '$hashed_password'
                WHERE id = $user_id
                ";
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if ($res === true) {
                $_SESSION['notification_msg'] = $success_msg;
                header("Location:" . SITEURL . 'main/account-info.php');
                exit;
            } else {
                $_SESSION['notification_msg'] = $failure_msg;
                header("Location:" . SITEURL . 'main/update-customer.php');
                exit;
            }
        }
    } else {

        // check if new email already exists
        checkEmail($new_email, $existing_email, $conn);

        $sql = "UPDATE tbl_customer SET
               full_name = '$full_name',
                address = '$adrs',
                mobile_number = $mobile_number,
                email = '$new_email'
                WHERE id = $user_id
                ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($res === true) {
            $_SESSION['notification_msg'] = $success_msg;
            header("Location:" . SITEURL . 'main/account-info.php');
            exit;
        } else {
            $_SESSION['notification_msg'] = $failure_msg;
            header("Location:" . SITEURL . 'main/update-customer.php');
            exit;
        }
    }
} else {

    $_SESSION['notification_msg'] = $failure_msg;

    // Redirect back to the manage-employees page
    header("Location:" . SITEURL . 'main/update-customer.php');
    exit;
}


?>
