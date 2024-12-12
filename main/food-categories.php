<?php include("../partials/navigation-bar.php"); ?>



<!-- categories section starts here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Food Categories</h2>
        <p class="text-center add-bottom-padding">Click on your favourite category to see the menu.</p>
        <div class="cat-grid-container">

            <?php
            $sql = "SELECT * FROM tbl_category WHERE available = 'Yes'";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $title = $rows['title'];
                        $image = $rows['image_name'];


            ?>
                        <div class="box">

                            <a href="<?php echo SITEURL . "main/food-menu.php?category=" . $title ?>"> <img src="<?php echo '../images/categories/' . $image; ?>" alt="<? echo $title ?>" class="image-responsive box-image">
                                <h3 class="food-title"> <?php echo $title ?> </h3>
                            </a>
                        </div>
            <?php
                    }
                }
            }
            ?>

</section>
<!-- categories section ends here -->

<?php include("../partials/footer.php"); ?>