<?php include("../partials/admin-header.php"); ?>
<?php include("../partials/admin-navigation-bar.php"); ?>

<!-- Main Content Section starts here -->

<!-- <section class="main-content"> -->

<!-- add-employee input form starts here! -->
<div class="overlay"> </div>
<div class="add-employee-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Add Employee</div>
    <form action="" method="post">
        <div>
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Full Name">
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password">
        </div>
        <div>
            <label for="re_password">Retype Password</label>
            <input type="password" id="re_password" name="re_password" placeholder="Retype Password">
        </div>
        <input type="submit" name="submit" value="Add Employee" class="add-employee-button">
    </form>

</div>

<!-- add-employee input form stops here! -->
<section class="main-content">


    <div class="container">
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

                <tr>
                    <td>1.</td>
                    <td>Shivaram Raut</td>
                    <td>shiva@gmail.com</td>
                    <td>
                        <a href="#" class="btn-secondary">Update </a>
                        <a href="#" class="btn-danger">Delete </a>
                    </td>

                </tr>
                <tr>
                    <td>1.</td>
                    <td>Shivaram Raut</td>
                    <td>shiva@gmail.com</td>
                    <td>
                        <a href="#" class="btn-secondary">Update </a>
                        <a href="#" class="btn-danger">Delete </a>
                    </td>

                </tr>



            </table>
        </div>
    </div>
</section>

<?php include("../partials/admin-footer.php"); ?>


<!-- Process the value from the form and save it in the database. -->

<?php

//  check whether the submit button is clicked or not.

if (isset($_POST['submit'])) {

    //  get data from the add-employee form: 

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    echo ($full_name . " " . $username . " " . $password .  " " . $re_password);

    // insert the data into the database:
    





}

?>