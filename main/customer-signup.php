<?php
include("../partials/navigation-bar.php");
?>

<div class="container">
    <!--  notification-msg box-->
    <?php if (isset($_SESSION['notification_msg'])): ?>
        <div class="notification-msg">
            <?php echo $_SESSION['notification_msg']; ?>
            <span class="cross cross1">&times;</span>
        </div>
        <script src="../javascript/notification-msg.js"></script>
        <?php unset($_SESSION['notification_msg']); // Clear the message after displaying 
        ?>
    <?php endif; ?>

    <!-- customer sign-up form starts here -->
    <div class="form" id="customer-sign-up-form" style="position: static; left: auto; top: auto; z-index: auto; transform: none;">
        <div class="form-heading">Sign Up</div>
        <form action="<?php echo SITEURL . 'customer-backend/customer-signup.php'; ?>" method="post" id="sign-up-form">
            <input type="hidden" name="form-id" value="customer-sign-up-form" />
            <div>
                <label for="full-name">Full Name</label>
                <input type="text" id="full-name" name="full-name" placeholder="Full Name" required>
            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Address" required>
            </div>
            <div>
                <label for="mobile-number">Mobile Number</label>
                <input type="tel" id="mobile-number" name="mobile-number" pattern="\d{10}" placeholder="Enter your mobile number" required>
            </div>

            <div>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>

            </div>
            <div>
                <label for="password2">Password</label>
                <input type="password" id="password2" class="password" name="password" placeholder="Password" required>
            </div>
            <div>
                <label for="re-password2">Retype Password</label>
                <input type="password" id="re-password2" class="re_password" name="re-password" placeholder="Retype Password" required>
            </div>
            <div>
                <input type="checkbox" id="check-box" class="check-box">
                <label id="show-password" class="show-password">Show Password</label>
            </div>
            <div class="clear-fix"></div>
            <div id="error-msg2" class="error-msg"></div>
            <button type="submit" name="submit">Sign Up</button>

        </form>
    </div>
</div>

<!-- customer sign-up  form stops here -->

<?php include("../partials/footer.php"); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('sign-up-form').addEventListener('submit', function(event) {
            // Get the password and re-password values
            const password = document.getElementById('password2').value;
            const re_password = document.getElementById('re-password2').value;
            const errorMessage = document.getElementById('error-msg2');

            // Check if passwords match
            if (password !== re_password) {
                // Prevent form submission
                event.preventDefault();
                // Show an error message
                errorMessage.textContent = "Confirmation password didn't match!";
            } else {
                // Clear any previous error message
                errorMessage.textContent = "";
            }
        });
    });
</script>