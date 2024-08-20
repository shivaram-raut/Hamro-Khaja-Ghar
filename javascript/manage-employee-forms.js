

document.addEventListener("DOMContentLoaded", function () {
    const update_employee_id = document.getElementById('update-employee-id');
    const delete_employee_id = document.getElementById('delete-employee-id');
    const update_employee_fullname = document.getElementById('update-employee-fullname');
    const update_employee_username = document.getElementById('update-employee-username');
    const existing_username = document.getElementById('existing-username');



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
        if (buttons) {
            buttons.forEach(function (button) {
                button.addEventListener("click", function () {
                    const delete_user_id = this.getAttribute('data-user-id');
                    if (delete_user_id) {
                        delete_employee_id.value=delete_user_id;

                    }

                    else {
                        const id = this.getAttribute('data-id');
                        if (id) {
                            update_employee_id.value = id;
                        }

                        const full_name = this.getAttribute('data-fullname');
                        if (full_name) {
                            update_employee_fullname.value = full_name;
                        }
                        const username = this.getAttribute('data-username');
                        if (username) {
                            update_employee_username.value = username;
                            existing_username.value = username;
                        }
                    }

                    showModal(formClass);
                });
            });
        }

        var closeButtons = document.querySelectorAll(".cross");
        if (closeButtons) {
            closeButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    closeModal(formClass);
                });
            });
        }
    }

    // Setup event listeners for different buttons
    handleButtonClick(".add-new-btn", ".add-form");
    handleButtonClick(".table-update-btn", ".update-form");
    handleButtonClick(".table-delete-btn", ".delete-form");

});
