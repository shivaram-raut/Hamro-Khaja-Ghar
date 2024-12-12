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
            <input type="radio" id="featured-yes" name="featured" value="Yes"><label for="featured-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="featured-no" name="featured" value="No"><label for="featured-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <div>
            <label style="margin:4% 0 1%;">Available:</label>
            <input type="radio" id="available-yes" name="available" value="Yes"><label for="available-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="available-no" name="available" value="No"><label for="available-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <input type="submit" name="submit" value="Add Category" class="form-add-btn submit-button" style="margin: 8% 0 4%;">
    </form>
</div>
<!-- add-category input form stops here! -->


<!-- update-category form starts here -->
<div class="form  update-form">
    <span class="cross">&times;</span>
    <div class="form-heading">Update Category</div>

    <form action="update-category.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="form_id" value="update-category-form" />
        <input type="hidden" name="id" id="update-category-id">
        <div>
            <label for="update-category-title">Title</label>
            <input type="text" id="update-category-title" name="title" required>
        </div>
        <div>
            <label for="new-category-image">Update Image:</label>
            <input type="file" id="new-category-image" name="image">
            <input type="hidden" name="existing-image" id="existing-image">

        </div>
        <div>
            <label style="margin:1% 0;">Featured:</label>
            <input type="radio" id="update-featured-yes" name="featured" value="Yes"><label for="update-featured-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="update-featured-no" name="featured" value="No"><label for="update-featured-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <div>
            <label style="margin:4% 0 1%;">Available:</label>
            <input type="radio" id="update-available-yes" name="available" value="Yes"><label for="update-available-yes" style="display:inline; cursor:pointer; margin-right: 15px;"> Yes </label>
            <input type="radio" id="update-available-no" name="available" value="No"><label for="update-available-no" style="display:inline; cursor:pointer;"> No </label>

        </div>
        <input type="submit" name="submit" value="Update Category" class="form-update-btn submit-button" style="margin: 8% 0 4%;">
    </form>
</div>
<!-- update-category form stops here! -->



<!-- Delete category form starts here -->
<div class="form delete-form" style="width: 30%;">
    <span class="cross">&times;</span>
    <br>
    <div class="form-heading">Delete Category</div>
    <div class="confirm-delete-qsn">Delete the category permanently.</div>
    <form action="delete-category.php" method="post">
        <input type="hidden" name="form_id" value="delete-category-form" />
        <input type="hidden" name="id" id="delete-category-id" />
        <input type="hidden" name="image" id="delete-category-image" />


        <input type="submit" name="submit" value="Delete" class=" submit-button delete-yes" />
        <span class="cross submit-button delete-no "  style="font-size: 18px; padding: 10px;"> Cancel</span>
        <div class="clear-fix"></div>


    </form>
</div>
<!-- delete-category form stops here! -->


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
                    <th>Featured</th>
                    <th>Available</th>
                    <th>Actions</th>


                </tr>

                <?php
                $sql = "SELECT * FROM tbl_category ORDER BY title ASC ";
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
                                <td style="width: 13%; overflow:hidden;" ;><img src='<?php echo "../images/categories/" . $image; ?>' style="width: 100%; margin: 0 auto;"></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $available; ?></td>


                                <td>
                                    <div>
                                        <span class="table-update-btn" data-id="<?php echo $id; ?>" data-title="<?php echo $title; ?>" data-image="<?php echo $image; ?>" data-featured="<?php echo $featured; ?>" data-available="<?php echo $available; ?>">&#9998;Update </span>

                                        <!-- <span class ="table-update-btn">&#9998; Update </span> -->

                                        <span class="table-delete-btn" data-item-id="<?php echo $id; ?>" data-image="<?php echo $image; ?>">&#128465;Delete</span>

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
<script src="../javascript/manage-category-form.js"></script>


<?php include("../partials/admin-footer.php"); ?>