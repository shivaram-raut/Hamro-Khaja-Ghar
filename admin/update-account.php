<?php include("../partials/admin-navigation-bar.php"); ?>

<div class="container">

    <?php
    if (isset($_SESSION['user-admin'])) {
        $user_id = $_SESSION['user-admin'];
        $sql = "SELECT * FROM tbl_admin WHERE id = $user_id ";
    } else {
        $user_id = $_SESSION['user-employee'];
        $sql = "SELECT * FROM tbl_employee WHERE id = $user_id ";
    }

    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        $row = mysqli_fetch_assoc($res);
        $full_name = $row['full_name'];
        $username = $row['username'];
    }
    ?>
    
    <div class="basic-details" style="width: 45%; margin: auto;">
        <div class="header">
            <h2>Update Account: </h2>
        </div>
        <div class="input-box form" style="position: static; left: auto; top: auto; z-index: auto; transform: none; width: 100%;  box-shadow: 0 0 4px 3px #e6e6e6; ">

            <?php if (isset($_SESSION['user-admin'])): ?>
                <form action="<?php echo SITEURL . 'admin/update-admin.php'; ?>" method="post" id="form1">
                    <input type="hidden" name="form-id" value="update-admin-form" />
                <?php elseif (isset($_SESSION['user-employee'])): ?>
                    <form action="<?php echo SITEURL . 'admin/update-employee.php'; ?>" method="post" id="form1">
                        <input type="hidden" name="form-id" value="update-employee-form" />
                    <?php endif; ?>

                    <input type="hidden" name="user-id" value="<?php echo $user_id; ?>">

                    <div>
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full-name" value="<?php echo $full_name; ?>" required>
                    </div>

                    <div>
                        <label for="username">Username</label>
                        <input type="hidden" name="existing-username" value="<?php echo $username; ?>">
                        <input type="username" id="username" name="username" value="<?php echo $username; ?>" required>

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

<?php include("../partials/admin-footer.php"); ?>

<script src="../javascript/re_password-check.js"> </script>