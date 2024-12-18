
<!-- Customer Login form starts here -->
<div class="overlay"> </div>
<div id="customer-login-form" class="form">
    <span class="cross">&times;</span>
    <div class="form-heading">Customer Login</div>
    <form action="<?php echo SITEURL. 'customer-backend/customer-login.php'; ?>" method="post">
    <input type="hidden" name="form-id" value="customer-login-form" />
    <input type="hidden" name="redirect-uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        <div>
            <label for=""> Email</label>
            <input type="email" name="email" placeholder="example@gmail.com" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" class="password" name="password" placeholder="Password" required>
        </div>
        <div>
            <input type="checkbox" id="check-box" class="check-box" onclick="showPassword()">
            <label id="show-password" class="show-password">Show Password</label>
        </div>
        <div class="clear-fix"></div>
        <div class="error-msg"></div>
        <button type="submit" name="submit">Login</button>
    </form>
    <div class='form-footer'>
        Don't have an account? <a href="customer-signup.php">Sign Up</a>
    </div>
</div>

<!-- Customer Login form stops here -->

<!-- Employee Login form starts here -->
<div class="overlay"> </div>
<div id="employee-login-form" class="form">
    <span class="cross">&times;</span>
    <div class="form-heading">Employee Login</div>
    <form action="../admin/employee-login.php" method="post">
        <input type="hidden" name="form-id" value="employee-login-form" />
        <input type="hidden" name="redirect-uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />

        <div>
            <label for="">Username</label>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" class="password" name="password" placeholder="Pssword" required>
        </div>
        <div>
            <input type="checkbox" id="check-box" class="check-box" onclick="showPassword()">
            <label id="show-password" class="show-password">Show Password</label>
        </div>
        <div class="clear-fix"></div>
        <div class="error-msg"></div>
        <button type="submit" name="submit">Login</button>
    </form>

</div>

<!-- Employee Login form stops here -->

<!-- Admin Login form starts here -->
<div class="overlay"> </div>
<div id="admin-login-form" class="form">
    <span class="cross">&times;</span>
    <div class="form-heading">Admin Login</div>
    <form action="../admin/admin-login.php" method="post">
        <input type="hidden" name="form-id" value="admin-login-form" />
        <input type="hidden" name="redirect-uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />

        <div>
            <label for="">Username</label>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" class="password" name="password" placeholder="Pssword" required>
        </div>
        <div>
            <input type="checkbox" id="check-box" class="check-box" onclick="showPassword()">
            <label id="show-password" class="show-password">Show Password</label>
        </div>
        <div class="clear-fix"></div>
        <div class="error-msg"></div>
        <button type="submit" name="submit">Login</button>
    </form>

</div>

<!-- Admin Login form stops here -->
