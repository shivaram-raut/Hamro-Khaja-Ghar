
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('sign-up-form').addEventListener('submit', function(event) {
            // Get the password and re-password values
            const password = document.getElementById('password2').value;
            const re_password = document.getElementById('re-password2').value;
            const errorMessage = document.getElementById('error-msg2');

            // Check if passwords match
            if (password !== re_password) {
                // Prevent form submission
                event.preventDefault();
                // Show an error message
                errorMessage.textContent = "Confirmation password didn't match!";
            } else {
                // Clear any previous error message
                errorMessage.textContent = "";
            }
        });
    });