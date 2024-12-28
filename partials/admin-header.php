<?php  include("../config/constants.php"); ?>

<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent)) {
    echo '<style>body { width: 1024px; }</style>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hamro-khaja-ghar</title>
    <link rel="icon" type="image/png" href="../images/favicon.png">

    <link rel="stylesheet" href="../css/admin-style.css">
    <script src="../javascript/active-page.js"></script>
    <script src="../javascript/show-password.js"></script>
</head>

<body>