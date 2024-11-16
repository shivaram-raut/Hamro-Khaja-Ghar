

document.addEventListener("DOMContentLoaded", function() {
    // Function to show the notification
    function showNotification() {
        document.querySelector('.notification-msg').classList.add('show-notification-msg');

        // Automatically close the notification after 4 seconds
        setTimeout(closeNotification, 6000);
    }

    // Function to close the notification
    function closeNotification() {
        document.querySelector('.notification-msg').classList.remove('show-notification-msg');
    }

    // Show notification after a short delay
    setTimeout(showNotification, 100);

    // Get elements for closing the notification
    var cross = document.querySelector(".cross1");
    var notificationMsg = document.querySelector(".notification-msg");

    // Add event listeners for closing the notification
    if (cross) {
        cross.addEventListener("click", closeNotification);
    }
    if (notificationMsg) {
        notificationMsg.addEventListener("click", closeNotification);
    }
    window.addEventListener("scroll", closeNotification);
});
