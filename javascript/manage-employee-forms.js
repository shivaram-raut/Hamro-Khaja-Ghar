

document.addEventListener("DOMContentLoaded", function () {
    const delete_employee_id = document.getElementById('delete-employee-id');

    // Function to show the modal
    function showModal(formClass) {
        document.querySelector('.overlay').classList.add('show-overlay');
        document.querySelector(formClass).classList.add('show-form');
    }

    // Function to close the modal
    function closeModal(formClass) {
        document.querySelector('.overlay').classList.remove('show-overlay');
        document.querySelector(formClass).classList.remove('show-form');
    }

    // Function to handle button clicks
    function handleButtonClick(buttonClass, formClass) {
        var buttons = document.querySelectorAll(buttonClass);
        if (buttons.length > 0) {
            buttons.forEach(function (button) {
                button.addEventListener("click", function () {
                    const delete_user_id = this.getAttribute('data-user-id');
                    if (delete_user_id) {
                        delete_employee_id.value=delete_user_id;

                    }

                    showModal(formClass);
                });
            });
        }

        var closeButtons = document.querySelectorAll(".cross");
        if (closeButtons.length > 0) {
            closeButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    closeModal(formClass);
                });
            });
        }
    }

    // Setup event listeners for different buttons
    handleButtonClick(".add-new-btn", ".add-form");
    handleButtonClick(".table-delete-btn", ".delete-form");

});
