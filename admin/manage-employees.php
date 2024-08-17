<?php
// Include necessary files and start the session at the very top
include("../partials/admin-header.php");
include("../partials/admin-navigation-bar.php");

// Process the value from the form and save it in the database.

// Check whether the submit button is clicked or not.
if (isset($_POST['submit'])) {

    // Get data from the add-employee form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    // Check if the passwords match
    if ($password === $re_password) {
        // Check if the username already exists
        $check_username = "SELECT * FROM tbl_employee WHERE username = '$username'";
        $check_res = mysqli_query($conn, $check_username);

        if (mysqli_num_rows($check_res) > 0) {
            // Username already exists
            $_SESSION['employee_added_msg'] = "Username already exists. Please choose a different one.";
        } else {
            // Encrypt the password using bcrypt
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the data into the database
            $sql = "INSERT INTO tbl_employee SET
                full_name = '$full_name',
                username = '$username',
                password = '$hashed_password'
                ";

            // Execute query and save the data in the database
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if ($res == true) {
                $_SESSION['employee_added_msg'] = "Employee added successfully!";
            } else {
                $_SESSION['employee_added_msg'] = "Something went wrong!";
            }
        }

        // Redirect back to the manage-employees page
        header("Location:" . SITEURL . 'admin/manage-employees.php');
        exit; // Stop script execution after the redirect
    } else {
        // Handle the case where passwords do not match
        $_SESSION['employee_added_msg'] = "Confirmation password didn't match!";
    }
}

// HTML and other content come after header logic
?>

<!-- Main Content Section starts here -->
<!-- add-employee input form starts here! -->
<div class="overlay"> </div>
<div class="add-employee-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Add Employee</div>
    <form action="" method="post">
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
        <input type="submit" name="submit" value="Add Employee" class="add-employee-button">
    </form>
</div>
<!-- add-employee input form stops here! -->

<section class="main-content">
    <div class="container">

        <!--  notification-msg box-->

        <?php if (isset($_SESSION['employee_added_msg'])): ?>
            <div class="notification-msg">
                <?php echo $_SESSION['employee_added_msg']; ?>
                <span class="cross cross1">&times;</span>
            </div>
            <script src="../javascript/notification-msg.js"></script>
            <?php unset($_SESSION['employee_added_msg']); // Clear the message after displaying 
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
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>

                                <td>
                                    <div>
                                        <span class="update-btn">&#9998; </span> <span class="update-txt">Update</span>
                                        <span class="delete-btn">&#128465; </span> <span class="delete-txt">Delete</span>
                                    </div>
                                </td>
                            </tr>

                <?php
                        }
                    }
                }
                ?>

                <!-- <tr>
                    <td>1.</td>
                    <td>Shivaram Raut</td>
                    <td>shiva@gmail.com</td>
                    <td>
                        <a href="#" class="btn-secondary">Update </a>
                        <a href="#" class="btn-danger">Delete </a>
                    </td>
                </tr> -->
            </table>
        </div>
    </div>
</section>

<?php include("../partials/admin-footer.php"); ?>