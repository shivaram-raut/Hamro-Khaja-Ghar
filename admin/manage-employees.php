<?php
include("../partials/admin-navigation-bar.php");
?>

<!-- add-employee input form starts here! -->
<div class="overlay"> </div>
<div class="form add-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Add Employee</div>
    <form action="add-employee.php" method="post">
        <input type="hidden" name="form_id" value="add-employee-form" />
        <div>
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" name="full-name" placeholder="Full Name" required>
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" class="password" name="password" placeholder="Password" required>
        </div>
        <div>
            <label for="re_password">Retype Password</label>
            <input type="password" id="re_password" class="re_password" name="re_password" placeholder="Retype Password" required>
        </div>
        <div>
            <input type="checkbox" id="check-box" class="check-box">
            <label id="show-password" class="show-password">Show Password</label>
        </div>
        <div class="clear-fix"></div>
        <input type="submit" name="submit" value="Add Employee" class="form-add-btn submit-button">
    </form>
</div>
<!-- add-employee input form stops here! -->

<!-- Delete employee form starts here -->
<div class="form delete-form" style="width: 31%;">
    <span class="cross">&times;</span>
    <div class="form-heading">Delete Employee</div>
    <div class="confirm-delete-qsn">Delete the employee permanently.</div>
    <form action="delete-employee.php" method="post">
        <input type="hidden" name="form_id" value="delete-employee-form" />
        <input type="hidden" name="id" id="delete-employee-id" />

        <input type="submit" name="submit" value="Delete" class=" submit-button delete-yes" />
        <span class="cross submit-button delete-no " style="font-size: 18px; padding: 10px;"> Cancel </span>
        <div class="clear-fix"></div>


    </form>
</div>
<!-- delete-employee form stops here! -->


<!-- Main Content Section starts here -->

<section class="main-content">
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

        <div class="page-heading">
            <h2> Manage Employee Accounts</h2>
        </div>

        <span class="btn-primary add-new-btn">Add Employee</span>

        <div class="items-list-table">
            <table class="table-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                $sql = "SELECT * FROM tbl_employee";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            $account_status = $rows['account_status'];

                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>

                                <td>
                                    <div>
                                    <span>
                                            <form action="<?php echo SITEURL . 'admin/manage-employee-account-status.php'; ?>" method="POST" style="display: inline;">
                                                <input type="hidden" name="form-id" value="employee-account-status">
                                                <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                <input type="hidden" name="status" value="<?php echo $account_status; ?>">

                                                <?php if ($account_status == 'activated'): ?>
                                                    <button type="submit" style="background: none; border:none; margin-right: 20px; color: red; cursor: pointer; font-size: 15px;">
                                                        &#9888; Deactivate Account
                                                    </button>

                                                    <?php elseif ($account_status == 'deactivated'): ?>
                                                        <button type="submit" style="background: none; border: none; margin-right: 30px; color:green; cursor: pointer; font-size: 15px;">
                                                            &#9888; Activate Account
                                                        </button>
                                                    <?php endif; ?>
                                            </form>
                                        </span>
                                        <span class="table-delete-btn" data-user-id="<?php echo $id; ?>">&#128465;Delete</span>

                                    </div>
                                </td>
                            </tr>

                <?php
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</section>

<!-- Adding the javascirpt file -->
<script src="../javascript/manage-employee-forms.js"></script>

<?php include("../partials/admin-footer.php"); ?>