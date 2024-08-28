
<?php include("../partials/admin-navigation-bar.php"); ?>

<!-- add-category input form starts here! -->
<div class="overlay"> </div>
<div class="form add-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Add Category</div>
    <form action="add-category.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_id" value="add-category-form" />
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Title" required>
        </div>
        <div>
            <label for="image">Select Image:</label>
            <input type="file" id="image" name="image" placeholder="Select Image" required>
        </div>
        <div>
            <label style="margin:1% 0;">Featured:</label>
            <input type="radio" id="featured-yes" name="featured" value="yes"><label for="featured-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="featured-no" name="featured" value="No"><label for="featured-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <div>
            <label style="margin:4% 0 1%;">Available:</label>
            <input type="radio" id="available-yes" name="available" value="yes"><label for="available-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="available-no" name="available" value="No"><label for="available-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <input type="submit" name="submit" value="Add Category" class="form-add-btn submit-button" style="margin: 8% 0 4%;">
    </form>
</div>
<!-- add-category input form stops here! -->


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
            <label id="show-password" >Show Password</label>
        </div>
        <div class="clear-fix"></div>
        <input type="submit" name="submit" value="Update Employee" class="form-update-btn submit-button">
    </form>
</div>
<!-- update-employee form stops here! -->



<!-- Delete employee form starts here -->
<div class="form delete-form" style="width: 30%;">
    <span class="cross">&times;</span>
    <br>
    <div class="form-heading">Delete Employee</div>
    <div class="confirm-delete-qsn">Are you sure you want to delete?</div>
    <form action="delete-employee.php" method="post">
        <input type="hidden" name="form_id" value="delete-employee-form" />
        <input type="hidden" name="id" id="delete-employee-id" />

        <input type="submit" name="submit" value="Yes" class=" submit-button delete-yes" />
        <span class="cross submit-button delete-no "> No </span>
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
            <h1> Manage Categories</h1>
        </div>

        <span class="btn-primary add-new-btn">Add Category</span>

        <div class="items-list-table">
            <table class="table-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th style="text-align:center;">Featured</th>
                    <th style="text-align:center;">available</th>
                    <th style="text-align:center;">Actions</th>


                </tr>

                <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image = $rows['image_name'];
                            $featured = $rows['featured'];
                            $available = $rows['available'];


                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td style="width: 13%; overflow:hidden;text-align:center;";><img src = '<?php echo "../images/categories/".$image; ?>' style="width: 100%; margin: 0 auto;"></td>
                                <td style="text-align:center;"><?php echo $featured; ?></td>
                                <td style="text-align:center;"><?php echo $available; ?></td>


                                <td>
                                    <div>
                                        <span class="table-update-btn" data-id="<?php echo $id; ?>" data-fullname="<?php echo $full_name; ?>" data-username="<?php echo $username; ?>">&#9998; Update </span>
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
