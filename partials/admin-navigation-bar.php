 <!-- navigation-bar Section  starts here-->
 <?php
    include('admin-header.php');

    if (!isset($_SESSION['admin-user'])) {
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
                     <a href="manage-menu.php">Foods</a>
                 </li>
                 <li>
                     <a href="manage-categories.php">Categories</a>
                 </li>
                 <li>
                     <a href="manage-employees.php">Employees</a>
                 </li>
                 <li>
                     <a href="index.php">My Account</a>
                 </li>
             </ul>
         </div>

         <div class="clear-fix"></div>
     </div>


 </section>