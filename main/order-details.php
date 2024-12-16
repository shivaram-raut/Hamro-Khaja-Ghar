<?php
if (!isset($_POST['form-id'])) {
    include("../config/constants.php");
    header("Location: " . SITEURL . 'main/order-page.php');
    exit();
} else {
    include("../partials/navigation-bar.php");
    include("../partials/order-details.php");
    include("../partials/footer.php");

}
?>

<script src="../javascript/order-details-page.js"></script>