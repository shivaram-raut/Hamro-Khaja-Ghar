<?php 
include('../config/constants.php');
?>
<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent)) {
    echo '<style>body { width: 1024px; }</style>';
}
?>

<!--  head section -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hamro Khaja Ghar</title>
    <link rel="icon" type="image/png" href="../images/favicon.png">


    <!-- linking css file -->
    <link rel="stylesheet" href="../css/style.css">
    <script src="../javascript/active-page.js"></script>
    <script src="../javascript/input-form.js"></script>
    <script src="../javascript/show-password.js"></script>


</head>

<body>