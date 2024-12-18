<?php include("../partials/admin-navigation-bar.php"); ?>

<?php
// function to count the rows
function getRowCount($tableName, $conn)
{

    $sql = "SELECT COUNT(*) AS total_rows FROM $tableName";

    $result = mysqli_query($conn, $sql);

    if ($result == true) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['total_rows'];
    } else {
        // If the query fails, return -1 as an error code
        $count = 0;
    }
    return $count;
}

$menu_items_row = getRowCount("tbl_menu", $conn);
$categories_row = getRowCount("tbl_category", $conn);
$customers_row = getRowCount("tbl_customer", $conn);
$order_row = getRowCount("tbl_order", $conn);

?>


<div class="container" style="min-height: 65vh;">
    <div style="margin: auto;">
        <!-- Dashboard Heading -->
        <div class="page-heading">
            <?php if (isset($_SESSION['user-admin'])): ?>
                <h2>Admin Dashboard</h2>
            <?php elseif (isset($_SESSION['user-employee'])): ?>
                <h2>Employee Dashboard</h2>
            <?php endif; ?>

        </div>

        <!-- Key Metrics Section -->
        <div class="box-container">
            <a href="<?php echo SITEURL . 'admin/manage-menu.php'; ?>">
                <div class="box">
                    <div class="box-heading">MENU ITEMS</div>
                    <div class="box-content"><?php echo $menu_items_row; ?></div>
                </div>
            </a>
            <a href="<?php echo SITEURL . 'admin/manage-categories.php'; ?>">
                <div class="box">
                    <div class="box-heading">CATEGORIES</div>
                    <div class="box-content"><?php echo $categories_row; ?></div>
                </div>
            </a>
            <a href="<?php echo SITEURL . 'admin/manage-customers.php'; ?>">
                <div class="box">
                    <div class="box-heading">CUSTOMERS</div>
                    <div class="box-content"><?php echo $customers_row; ?></div>
                </div>
            </a>
            <a href="<?php echo SITEURL . 'admin/order-table.php'; ?>">
                <div class="box">
                    <div class="box-heading">ORDERS</div>
                    <div class="box-content"><?php echo $order_row; ?></div>
                </div>
            </a>
        </div>

        <!-- Quick Links Section -->
        <div class="quick-links">
            <h3>Quick Links</h3>
            <div class="links-container">
                <a href="<?php echo SITEURL . 'admin/manage-menu.php'; ?>" class="quick-link">Manage Menu Items</a>
                <a href="<?php echo SITEURL . 'admin/manage-categories.php'; ?>" class="quick-link">Manage Categories</a>
                <a href="<?php echo SITEURL . 'admin/order-table.php'; ?>" class="quick-link">View Orders</a>
                <a href="<?php echo SITEURL . 'admin/manage-customers.php'; ?>" class="quick-link">Manage Customers</a>
                <a href="<?php echo SITEURL . 'admin/order-history.php'; ?>" class="quick-link">View Order History</a>
                <?php if (isset($_SESSION['user-admin'])): ?>
                    <a href="<?php echo SITEURL . 'admin/manage-employees.php'; ?>" class="quick-link">Manage Employess</a>
                <?php endif; ?>

            </div>
        </div>

        <!-- Recent Notifications Section -->
        <div class="notifications">
            <h3>Recent Notifications</h3>
            <ul class="notifications-list">
                <li class="notification-item">New Order #1234 placed by John Doe.</li>
                <li class="notification-item">Low stock alert for "Chicken Burger".</li>
                <li class="notification-item">New customer "Jane Smith" registered.</li>
            </ul>
        </div>

    </div>
</div>

<?php include("../partials/admin-footer.php"); ?>