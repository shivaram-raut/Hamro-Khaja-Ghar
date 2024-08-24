  
 <?php include("../partials/admin-navigation-bar.php"); ?>

 <section class="main-content">

     <!-- update-admin form starts here -->
     <div class="overlay"></div>
     <div class="form" id="admin-update-form">
         <span class="cross">&times;</span>
         <div class="form-heading">Update Account</div>
         <form action="update-admin.php" method="post">
             <input type="hidden" name="form-id" value="update-admin-form" />
             <div>
                 <label for="update_employee_fullname">Full Name</label>
                 <input type="text" id="update-admin-fullname" name="full-name" placeholder="Full Name" required>
             </div>
             <div>
                 <label for="update_employee_username">Username</label>
                 <input type="text" id="update-employee-username" name="username" placeholder="Username" required>
             </div>
             <div>
                 <label for="password">Password</label>
                 <input type="password" id="password" class="password" name="password" placeholder="Password" required>
             </div>
             <div>
                 <label for="re_password" >Retype Password</label>
                 <input type="password" id="re-password" class="re_password" name="re-password" placeholder="Retype Password" required>
             </div>
             <div>
            <input type="checkbox" id="check-box" class="check-box">
            <label id="show-password" >Show Password</label>
        </div>
        <div class="clear-fix"></div>
             <input type="submit" name="submit" value="Update Admin" class="form-update-btn submit-button">
         </form>
     </div>

     <!-- update-admin form starts here -->


     <div class="container">
         <?php if (isset($_SESSION['notification_msg'])): ?>
             <div class="notification-msg">
                 <?php echo $_SESSION['notification_msg']; ?>
                 <span class="cross cross1">&times;</span>
             </div>
             <script src="../javascript/notification-msg.js"></script>
             <?php unset($_SESSION['notification_msg']); // Clear the message after displaying 
                ?>
         <?php endif; ?>
         <span class="btn-secondary" id="admin-update-btn">Update Account</span>
         <form action="admin-logout.php" method="post">
            <input type="submit" value="Log Out" />
         </form>


     </div>
 </section>


 <!-- Adding the javascript file -->
 <script src="../javascript/input-form.js"></script>
 <?php include("../partials/admin-footer.php"); ?>