 <!-- navigation-bar Section  starts here-->
 <?php
    include('admin-header.php');

    // if (!isset($_SESSION['admin-user'])) {
    //     header('Location:' . SITEURL . 'index.php');
    // }
    ?>

 <section class="navigation-bar">
     <div class="container">
         <div class="logo">
             <a href="../index.php"> <img src="../images/logo.png" class="image-responsive"></a>
         </div>
         <div class="menu">
             <ul>
                 <li>
                     <a href="../index.php">Home</a>
                 </li>
                 <li>
                     <a href="order-table.php">Order</a>
                 </li>
                 <li>
                     <a href="dashboard.php">Dashboard</a>
                 </li>
                 <li class="dropdown-btn">
                        <a>My Account</a>
                        <ul id="dropdown">
                            <a href="<?php echo SITEURL . 'main/account-info.php' ?>">
                                <li>Account Info</li>
                            </a>
                            <a href="<?php echo SITEURL . 'main/order-page.php' ?>">
                                <li>Order History</li>
                            </a>
                            <a href="<?php echo SITEURL . 'customer-backend/customer-logout.php' ?>">
                                <li>Logout</li>
                            </a>
                        </ul>
                    </li>
             </ul>
         </div>

         <div class="clear-fix"></div>
     </div>


 </section>