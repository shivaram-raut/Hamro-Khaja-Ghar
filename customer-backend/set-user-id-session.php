<?php
include("../config/constants.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user-id'])) {
    $user_id = intval($_POST['user-id']); 

        $_SESSION['user-id'] = $user_id;

    // Redirect back to the homepage or another desired page
    header("Location:". SITEURL. "index.php");
    exit;
} else {
    // If accessed directly, redirect to homepage
    header("Location:". SITEURL. "index.php");

    exit;
}
?>
