<?php
include("../config/constants.php");

function invalidCreds($redirect_uri)
{
    $errorMessage = "Invalid email or password.";
    header("Location:" . $redirect_uri . "?error=" . urlencode($errorMessage) . "&show=customer-login-form");
    exit;
}

if (isset($_POST['submit']) && $_POST['form-id'] == 'customer-login-form') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $redirect_uri = $_POST['redirect-uri'];

    // truncating the query string parts if there already is:

    $parsed_url = parse_url($redirect_uri);

    if (isset($parsed_url['query'])) {
        $new_redirect_uri = '';

        if (isset($parsed_url['scheme'])) {
            $new_redirect_uri .= $parsed_url['scheme'] . '://';
        }

        if (isset($parsed_url['host'])) {
            $new_redirect_uri .= $parsed_url['host'];
        }

        if (isset($parsed_url['path'])) {
            $new_redirect_uri .= $parsed_url['path'];
        }

        // Set the final redirect URI without query parameters
        $redirect_uri = $new_redirect_uri;
    }

    $sql = "SELECT * FROM tbl_customer WHERE email = '$email' ";

    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $hashed_password = $row['password'];
        $user_id = $row['id'];
        $account_status = $row['account_status'];

        if (password_verify($password, $hashed_password)) {

            if ($account_status == 'deactivated') {
                $_SESSION['notification_msg'] = "Dear Customer, your account has been deactivated.";
                header("Location:" . SITEURL . "main/index.php");
                exit;
            } else {
                $_SESSION['user-id'] = $user_id;
                //storing the user-id in the local storage
                echo "<script> 
                localStorage.setItem('user-id', '$user_id'); 
                window.location.href = '" . SITEURL . "main/index.php';
                </script>";

                exit;
            }
        } else {
            invalidCreds($redirect_uri);
        }
    } else {
        invalidCreds($redirect_uri);
    }
} else {
    header("Location:" . SITEURL . "main/index.php");
}
