<?php
include("../partials/admin-navigation-bar.php");
?>

<section class="main-content">
    <div class="container" style="width: 90%;">
    <?php if (isset($_SESSION['notification_msg'])): ?>
            <div class="notification-msg">
                <?php echo $_SESSION['notification_msg']; ?>
                <span class="cross cross1">&times;</span>
            </div>
            <script src="../javascript/notification-msg.js"></script>
            <?php unset($_SESSION['notification_msg']);  
            ?>
        <?php endif; ?>

        <div class="page-heading">
            <h2> Manage Customers Accounts</h2>
        </div>

        <div class=" items-list-table">
            <table class="table-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full name</th>
                    <th>Address</th>
                    <th>Phone Num </th>
                    <th>Email </th>
                    <th>Actions</th>
                </tr>

                <?php
                $sql = "SELECT * FROM tbl_customer";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $user_id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $address = $rows['address'];
                            $mobile_number = $rows['mobile_number'];
                            $email = $rows['email'];
                            $account_status = $rows['account_status'];

                ?>
                            <tr>
                                <td style="width: 5%;"><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $address; ?></td>
                                <td style="width: 10%;"><?php echo $mobile_number; ?></td>
                                <td><?php echo $email ?></td>


                                <td style="width: 28%;">
                                    <div>
                                        <span>
                                            <form action="<?php echo SITEURL . 'admin/customer-order-history.php'; ?>" method="POST" style="display: inline;">
                                                <input type="hidden" name="form-id" value="customer-details">
                                                <input type="hidden" name="user-id" value="<?php echo $user_id; ?>">
                                                <button type="submit" style="background: none; border: none; color: #008fb3; cursor: pointer; font-size: 15px;">
                                                    &#128065; Order History
                                                </button>
                                            </form>
                                        </span>
                                        <span>
                                            <form action="<?php echo SITEURL . 'admin/manage-customer-account-status.php'; ?>" method="POST" style="display: inline;">
                                                <input type="hidden" name="form-id" value="customer-account-status">
                                                <input type="hidden" name="user-id" value="<?php echo $user_id; ?>">
                                                <input type="hidden" name="status" value="<?php echo $account_status; ?>">

                                                <?php if ($account_status == 'activated'): ?>
                                                    <button type="submit" style="background: none; border: none; margin-left: 20px; color: red; cursor: pointer; font-size: 15px;">
                                                        &#9888; Deactivate Account
                                                    </button>

                                                    <?php elseif ($account_status == 'deactivated'): ?>
                                                        <button type="submit" style="background: none; border: none; margin-left: 30px; color:green; cursor: pointer; font-size: 15px;">
                                                            &#9888; Activate Account
                                                        </button>
                                                    <?php endif; ?>
                                            </form>
                                        </span>

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