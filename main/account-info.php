<?php
include("../partials/navigation-bar.php");
?>

<div class="container">
    <?php
    $user_id = $_SESSION['user-id'];
    $sql = "SELECT * FROM tbl_customer WHERE id = $user_id ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        $row = mysqli_fetch_assoc($res);
        $full_name = $row['full_name'];
        $adrs = $row['address'];
        $mobile_number = $row['mobile_number'];
        $email = $row['email'];
    }

    ?>

    <div class="basic-details" style="width: 40%; margin: auto;">
        <div class="header">
            <h2>Account Information:</h2>
        </div>
        <div class="input-box" style=" box-shadow: 0 0 4px 3px #e6e6e6;">
            <div>
                <label for="full-name">Full Name</label>
                <input type="text" id="full-name" name="full-name" value="<?php echo $full_name ?>" disabled>
            </div>
            <div>
                <label for="mobile-number">Mobile Number</label>
                <input type="tel" id="mobile-number" name="mobile-number" value="<?php echo $mobile_number ?>" disabled>
            </div>

            <div>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>" disabled>

            </div>

            <div>
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="2" cols="40" disabled><?php echo $adrs ?> </textarea>
            </div>
            <form action="<?php echo SITEURL.'main/update-customer.php' ?>" method="post">
            <input type="submit" name="submit" value="Update Account" class="update-button" style="border:none">

            </form>

        </div>


    </div>
</div>

<?php
include("../partials/footer.php");
?>