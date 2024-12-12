

document.addEventListener("DOMContentLoaded", function () {
    
    const delete_order_id = document.getElementById('delete-order-id');

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

                    if (buttonClass === '.delete-odr-btn') {
                        const order_id = this.getAttribute('data-order-id');
                        if (order_id) {
                            delete_order_id.value = order_id;
                        } 
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
    handleButtonClick(".delete-odr-btn", ".delete-form");

});

 