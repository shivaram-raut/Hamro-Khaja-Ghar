<?php
if (!isset($_POST['form-id'])) {
    include("../config/constants.php");
    header("Location: " . SITEURL . 'admin/dashboard.php');
    exit();
} else {
    include("../partials/admin-navigation-bar.php");
    include("../partials/order-details.php");
    include("../partials/admin-footer.php");
}
?>

<script src="../javascript/order-details-page.js"></script>