<script src="../javascript/cart-items-num.js"></script>
<?php
include("header.php");

include("notification-msg.php");

include("set-user-id-session.php");
?>

<!-- home-navigation-bar Section  starts here-->
<section class="navigation-bar">
    <div class="container">
        <div class="logo">
            <a href="index.php"> <img src="../images/logo.png" class="image-responsive"></a>
        </div>
        <div class="menu">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="food-menu.php">Menu</a>
                </li>
                <li>
                    <a href="food-categories.php">Categories</a>
                </li>
                <?php if (isset($_SESSION['user-id'])): ?>
                <li>
                    <a href="my-cart.php">My Cart <span id="cart-items-count">0</span></a>
                </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['admin-user'])): ?>
                    <li>
                        <a href="admin/index.php"> Dashboard </a>
                    </li>
                <?php elseif (isset($_SESSION['user-id'])): ?>
                    <li class="dropdown-btn">
                        <a>My Account</a>
                        <ul id="dropdown">
                            <a href="<?php echo SITEURL . 'main/account-info.php' ?>">
                                <li>Account Info</li>
                            </a>
                            <a href="<?php echo SITEURL . 'main/order-page.php' ?>">
                                <li>Order Page</li>
                            </a>
                            <a href="<?php echo SITEURL . 'customer-backend/customer-logout.php' ?>">
                                <li>Logout</li>
                            </a>
                        </ul>
                    </li>

                <?php else: ?>
                    <li class="dropdown-btn">
                        <a id="login-btn">Login </a>
                        <ul id="dropdown">
                            <li id="customer-login-btn">Customer</li>
                            <li id="employee-login-btn">Employee</li>
                            <li id="admin-login-btn">Admin</li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="clear-fix"></div>
    </div>


</section>
<!-- navigation-bar Section  ends here-->

<?php include("login-forms.php"); ?>