
<?php
include("../config/constants.php");
// Check whether the submit button is clicked or not.
if (isset($_POST['submit']) && $_POST['form_id'] == 'form1') {

    // Get data from the add-employee form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];


    // Check if the passwords match
    if ($password === $re_password) {
        // Check if the username already exists
        $check_username = "SELECT * FROM tbl_employee WHERE username = '$username'";
        $check_res = mysqli_query($conn, $check_username);

        if (mysqli_num_rows($check_res) > 0) {
            // Username already exists
            $_SESSION['notification_msg'] = "Username already exists. Please choose a different one.";
        } else {
            // Encrypt the password using bcrypt
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the data into the database
            $sql = "INSERT INTO tbl_employee SET
                full_name = '$full_name',
                username = '$username',
                password = '$hashed_password'
                ";

            // Execute query and save the data in the database
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if ($res == true) {
                $_SESSION['notification_msg'] = "Employee added successfully!";
            } else {
                $_SESSION['notification_msg'] = "Something went wrong!";
            }
        }

        // Redirect back to the manage-employees page
        header("Location:" . SITEURL . 'admin/manage-employees.php');
        exit;
    } else {

        $_SESSION['notification_msg'] = "Confirmation password didn't match!";
        
        // Redirect back to the manage-employees page
        header("Location:" . SITEURL . 'admin/manage-employees.php');

    }
}
else{
    header("Location:" . SITEURL . 'admin/manage-employees.php');

}

?>
