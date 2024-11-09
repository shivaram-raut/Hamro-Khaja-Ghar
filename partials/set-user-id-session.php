<?php 
if(!isset($_SESSION['user-id'])): ?>
    <form id="set-user-id-session-form" method="POST" action="<?php echo SITEURL. 'customer-backend/set-user-id-session.php'; ?> ">
    <input type="hidden" name="user-id" id="user-id-input">
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const userId = localStorage.getItem('user-id');
    
    if (userId) {
        // Set the value of the hidden input field
        document.getElementById('user-id-input').value = userId;

        // Submit the form
        document.getElementById('set-user-id-session-form').submit();
    }
});
</script>

<?php endif; ?>

