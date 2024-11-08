<?php include("header.php"); ?>
<?php include("notification-msg.php"); ?>

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

                <?php if (isset($_SESSION['admin-user'])): ?>
                    <li>
                        <a href="admin/index.php"> Dashboard </a>
                    </li>
                <?php else: ?>
                    <li class="login-btn">
                        <a id="login-btn">Login </a>
                        <ul id="dropdown">
                            <li id="customer-login-btn">Customer</li>
                            <li id="employee-login-btn">Employee</li>
                            <li id="admin-login-btn">Admin</li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="my-cart.php">My Cart </a>
                </li>
            </ul>
        </div>
        <div class="clear-fix"></div>
    </div>


</section>
<!-- navigation-bar Section  ends here-->

<?php include("login-forms.php"); ?>