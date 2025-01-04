<?php include("../partials/navigation-bar.php"); ?>

<div class="container">

<?php
    $user_id = $_SESSION['user-id'];
    $sql = "SELECT * FROM tbl_customer WHERE id = $user_id ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        $row = mysqli_fetch_assoc($res);
        $full_name = $row['full_name'];
        $adrs = $row['address'];
        $mobile_number = $row['mobile_number'];
        $email = $row['email'];
    }
    ?>
    
    <div class="basic-details" style="width: 45%; margin: auto;">
        <div class="header">
            <h2>Update Account: </h2>
        </div>
    <div class="input-box form" style="position: static; left: auto; top: auto; z-index: auto; transform: none; width: 100%;  box-shadow: 0 0 4px 3px #e6e6e6; ">

        <form action="<?php echo SITEURL . 'customer-backend/customer-update.php'; ?>" method="post" id="form1">
        <input type="hidden" name="form-id" value="update-customer-form" />
            <div>
                <label for="full-name">Full Name</label>
                <input type="hidden" name="user-id" value="<?php echo $user_id;?>" >
                <input type="text" id="full-name" name="full-name" value="<?php echo $full_name; ?>" required>
            </div>
            <div>
                <label for="mobile-number">Mobile Number</label>
                <input type="tel" id="mobile-number" name="mobile-number" pattern="\d{10}" value="<?php echo $mobile_number; ?>" required>
            </div>

            <div>
                <label for="email">Email Address</label>
                <input type="hidden" name="existing-email" value="<?php echo $email; ?>">
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $adrs; ?>" required>
            </div>
            <div>
                <label for="password2">Update Password</label>
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
            <input type="submit" name="submit" value="Save Changes" class="update-button" style="border:none">

        </form>
    </div>
</div>
</div> 

<?php include("../partials/footer.php"); ?>

<script src="../javascript/re_password-check.js"> </script>