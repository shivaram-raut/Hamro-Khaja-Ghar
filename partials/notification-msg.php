
    <!--  notification-msg box-->
    <?php if (isset($_SESSION['notification_msg'])): ?>
        <div class="notification-msg">
            <?php echo $_SESSION['notification_msg']; ?>
            <span class="cross1">&times;</span>
        </div>
        <script src="../javascript/notification-msg.js"></script>
        <?php unset($_SESSION['notification_msg']); // Clear the message after displaying 
        ?>
    <?php endif; ?>