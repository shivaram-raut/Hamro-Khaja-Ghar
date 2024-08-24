<?php include("header.php"); ?>

<!-- home-navigation-bar Section  starts here-->
<section class="navigation-bar">
    <div class="container">
        <div class="logo">
            <a href="index.php"> <img src="images/logo.png" class="image-responsive"></a>
        </div>
        <div class="menu">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="food-categories.php">Foods</a>
                </li>
                <?php if(isset($_SESSION['admin-user'])): ?>
                    <li>
                        <a href="admin/index.php"> Dashboard </a>
                    </li>
                    <?php else: ?>
                <li class="login-btn">
                    <a href="#">Login </a>
                    <ul id="dropdown">
                        <li id="customer-login-btn">Customer</li>
                        <li id="employee-login-btn">Employee</li>
                        <li id="admin-login-btn">Admin</li>
                    </ul>
                </li>
                <?php endif; ?>

                <li>
                    <a href="#">My Cart </a>
                </li>
            </ul>
        </div>
        <div class="clear-fix"></div>
    </div>


</section>
<!-- navigation-bar Section  ends here-->


<!-- Customer Login form starts here -->
<div class="overlay"> </div>
<div id="customer-login-form" class="form">
    <span class="cross">&times;</span>
    <div class="form-heading">Login</div>
    <form action="">
        <div>
            <label for=""> Email</label>
            <input type="text" placeholder="example@gmail.com">
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" placeholder="password">
        </div>
        <button><a href="#"> Login</a></button>
    </form>
    <div class='form-footer'>
        Don't have an account? <a href="#">Sign Up</a>
    </div>
</div>

<!-- Customer Login form stops here -->

<!-- Admin/Employee Login form starts here -->
<div class="overlay"> </div>
<div id="admin-login-form" class="form">
    <span class="cross">&times;</span>
    <div class="form-heading">Login</div>
    <form action="admin/verify-admin.php" method="post">
        <input type="hidden" name="form-id" value="admin-login-form" />
        <input type="hidden" name="redirect-uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />

        <div>
            <label for="">Username</label>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" id="password" class="password" name="password" placeholder="Pssword" required>
        </div>
        <div>
            <input type="checkbox" id="check-box" class="check-box" onclick="showPassword()" >
            <label id="show-password" >Show Password</label>
        </div>
        <div class="clear-fix"></div>
        <div id="error-msg"></div>
        <button type="submit" name="submit">Login</button>
    </form>

</div>

<!-- Admin/Employee Login form stops here -->