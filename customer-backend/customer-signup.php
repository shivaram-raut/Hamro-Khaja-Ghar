
<?php
include("../config/constants.php");


// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form-id'] === 'customer-sign-up-form') {

    // Get data from the add-employee form
    // Sanitize user input
    $full_name = htmlspecialchars(trim($_POST['full-name']), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8');
    $mobile_number = $_POST['mobile-number'];
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
    $password = trim($_POST['password']);
    $re_password = trim($_POST['re-password']);


    // Check if the passwords match
    if ($password === $re_password) {
        // Check if the username already exists
        $check_email = "SELECT email FROM tbl_customer WHERE email = '$email'";
        $check_res = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($check_res) > 0) {
            // Username already exists
            $_SESSION['notification_msg'] = "There is already another account registered with this email id.";
            // Redirect back to the sign-up page
            header("Location:" . SITEURL . 'main/customer-signup.php');
            exit;
        } else {
            // Encrypt the password using bcrypt
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the data into the database
            $sql = "INSERT INTO tbl_customer SET
                full_name = '$full_name',
                address = '$address',
                mobile_number = $mobile_number,
                email = '$email',
                password = '$hashed_password'
                ";

            // Execute query and save the data in the database
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if ($res == true) {
                // Redirect back to the home page
                header("Location:" . SITEURL . 'index.php');
                exit;
            } else {
                $_SESSION['notification_msg'] = "Something went wrong!";
                // Redirect back to the sign-up page
                header("Location:" . SITEURL . 'main/customer-signup.php');
                exit;
            }
        }
    } else {

        $_SESSION['notification_msg'] = "Confirmation password didn't match!";

         // Redirect back to the sign-up page
         header("Location:" . SITEURL . 'main/customer-signup.php');
         exit;
    }
}
 else {
    header("Location:" . SITEURL . 'main/customer-signup.php');
}

?>
