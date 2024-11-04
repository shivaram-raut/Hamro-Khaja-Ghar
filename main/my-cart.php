<?php include("../partials/navigation-bar.php"); ?>

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
        <span class="cross submit-button delete-no "> Cancel</span>
        <div class="clear-fix"></div>


    </form>
</div>
<!-- delete-category form stops here! -->

<div class="container">
    <h2 style="text-align: center; margin: 1%;"> My Cart </h2>
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
                            <td style="width: 10%; overflow:hidden;" ;><img src='<?php echo "../images/categories/" . $image; ?>' style="width: 100%; margin: 0 auto;"></td>
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


<?php include("../partials/footer.php"); ?>