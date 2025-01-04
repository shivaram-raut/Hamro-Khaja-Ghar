document.getElementById("form1").addEventListener("submit", function (event) {
    const fullName = document.getElementById("full-name").value.trim();
    const errorMsg = document.getElementById("error-msg3");

    // Regular expression to check for numbers in the full name
    const namePattern = /^[a-zA-Z\s]+$/;

    if (!namePattern.test(fullName)) {
        // Prevent form submission
        event.preventDefault();

        // Display error message
        errorMsg.textContent = "Full Name cannot contain numbers or special characters.";
        errorMsg.style.color = "red";
    } else {
        // Clear the error message if validation passes
        errorMsg.textContent = "";
    }
});
