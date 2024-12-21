<?php
include("../partials/admin-navigation-bar.php");
?>

<div class="container">
    <?php
    if(isset($_SESSION['user-admin'])){
    $user_id = $_SESSION['user-admin'];
    $sql = "SELECT * FROM tbl_admin WHERE id = $user_id ";

    }
    elseif(isset($_SESSION['user-employee'])){
        $user_id = $_SESSION['user-employee'];
        $sql = "SELECT * FROM tbl_employee WHERE id = $user_id ";

    }
    else{
        header("Location:". SITEURL. 'index.php');
        
    }
    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        $row = mysqli_fetch_assoc($res);
        $full_name = $row['full_name'];
        $username = $row['username'];
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
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $username ?>" disabled>

            </div>
            <br>
            <form action="<?php echo SITEURL.'admin/update-account.php' ?>" method="post">
            <input type="submit" name="submit" value="Update Account" class="update-button" style="border:none">

            </form>
        </div>
    </div>
</div>

<?php
include("../partials/admin-footer.php");
?>