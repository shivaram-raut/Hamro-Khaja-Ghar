<?php
include("../config/constants.php");


if (isset($_SESSION['user-id'])) {
    session_unset();
    session_destroy();

    // Remove the user-id from local storage using JavaScript
    echo "<script>
localStorage.removeItem('user-id'); 
window.location.href = '" . SITEURL . "index.php';
</script>";
}
