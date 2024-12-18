 <!-- navigation-bar Section  starts here-->
 <?php
    include('admin-header.php');

    if (!isset($_SESSION['user-admin']) && (!isset($_SESSION['user-employee']))) {
        header('Location:' . SITEURL . 'index.php');
    }
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
                         <li><a href="<?php echo SITEURL . 'admin/my-account.php' ?>">Account Info</a></li>

                         <?php if (isset($_SESSION['user-admin'])): ?>
                             <li><a href="<?php echo SITEURL . 'admin/admin-logout.php' ?>">Logout</a></li>

                         <?php elseif (isset($_SESSION['user-employee'])): ?>
                             <li><a href="<?php echo SITEURL . 'admin/employee-logout.php' ?>">Logout</a></li>
                         <?php endif; ?>
                     </ul>
                 </li>
             </ul>
         </div>

         <div class="clear-fix"></div>
     </div>


 </section>