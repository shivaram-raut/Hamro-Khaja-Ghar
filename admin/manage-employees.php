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


<!-- update-employee form starts here -->
<div class="form  update-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Update Employee</div>
    <form action="update-employee.php" method="post">
        <input type="hidden" name="form_id" value="update-employee-form" />
        <input type="hidden" name="id" id="update-employee-id">
        <div>
            <label for="update-employee-fullname">Full Name</label>
            <input type="text" id="update-employee-fullname" name="full_name" required>
        </div>
        <input type="hidden" name="existing-username" id="existing-username">
        <div>
            <label for="update-employee-username">Username</label>
            <input type="text" id="update-employee-username" name="username" placeholder="Username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" class="password" name="password" placeholder="Password">
        </div>
        <div>
            <label for="re_password">Retype Password</label>
            <input type="password" id="re_password" class="re_password" name="re_password" placeholder="Retype Password">
        </div>
        <div>
            <input type="checkbox" id="check-box" class="check-box">
            <label id="show-password" class="show-password">Show Password</label>
        </div>
        <div class="clear-fix"></div>
        <input type="submit" name="submit" value="Update Employee" class="form-update-btn submit-button">
    </form>
</div>
<!-- update-employee form stops here! -->



<!-- Delete employee form starts here -->
<div class="form delete-form" style="width: 31%;">
    <span class="cross">&times;</span>
    <div class="form-heading">Delete Employee</div>
    <div class="confirm-delete-qsn">Delete the employee permanently.</div>
    <form action="delete-employee.php" method="post">
        <input type="hidden" name="form_id" value="delete-employee-form" />
        <input type="hidden" name="id" id="delete-employee-id" />

        <input type="submit" name="submit" value="Delete" class=" submit-button delete-yes" />
        <span class="cross submit-button delete-no "> Cancel </span>
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
            <h1> Manage Employee Accounts</h1>
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

                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>

                                <td>
                                    <div>
                                        <span class="table-update-btn" data-id="<?php echo $id; ?>" data-fullname="<?php echo $full_name; ?>" data-username="<?php echo $username; ?>">&#9998;Update </span>
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