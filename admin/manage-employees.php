<?php
include("../partials/admin-header.php");
include("../partials/admin-navigation-bar.php");
?>

<!-- add-employee input form starts here! -->
<div class="overlay"> </div>
<div class="form add-employee-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Add Employee</div>
    <form action="add-employee.php" method="post">
        <input type="hidden" name="form_id" value="form1" />
        <div>
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Full Name" required>
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div>
            <label for="re_password">Retype Password</label>
            <input type="password" id="re_password" name="re_password" placeholder="Retype Password" required>
        </div>
        <input type="submit" name="submit" value="Add Employee" class="add-employee submit-button">
    </form>
</div>
<!-- add-employee input form stops here! -->


<!-- update-employee form starts here -->
<div class="form  update-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Update Employee</div>
    <form action="update-employee.php" method="post">
        <input type="hidden" name="form_id" value="form2" />
        <input type="hidden" name="id" id="update_employee_id">
        <div>
            <label for="update_employee_fullname">Full Name</label>
            <input type="text" id="update_employee_fullname" name="full_name" required>
        </div>
        <input type="hidden" name="existing-username" id="existing-username">
        <div>
            <label for="update_employee_username">Username</label>
            <input type="text" id="update_employee_username" name="username" placeholder="Username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password">
        </div>
        <div>
            <label for="re_password">Retype Password</label>
            <input type="password" id="re_password" name="re_password" placeholder="Retype Password">
        </div>
        <input type="submit" name="submit" value="Update Employee" class="update-employee submit-button">
    </form>
</div>
<!-- update-employee form stops here! -->



<!-- Delete employee form starts here -->
<div class="form delete-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Delete Employee</div>
    <div class="confirm-delete">Are you sure you want to delete?</div>
    <form action="" method="post">
        <input type="hidden" name="id" id="delete_employee_id">
        <input type="radio" id="yes" name="delete-user" value="yes">
        <label for="yes">Yes</label><br>
        <input type="radio" id="no" name="delete-user" value="no">
        <label for="no">No <label><br>
        <input type="submit" name="submit" value=" Delete employee" class="add-employee-button">

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

        <div class="heading">
            <h1> Manage Employee Accounts</h1>
        </div>

        <span class="btn-primary add-employee">Add Employee</span>

        <div class="employee-table">
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

                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>

                                <td>
                                    <div>
                                        <span class="update-employee-btn" data-id="<?php echo $id; ?>" data-fullname="<?php echo $full_name; ?>" data-username="<?php echo $username; ?>">&#9998; Update </span>
                                        <span class="delete-employee-btn" data-user-id="<?php echo $id; ?>">&#128465;Delete</span>

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

<?php include("../partials/admin-footer.php"); ?>