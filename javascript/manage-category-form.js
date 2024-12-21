

document.addEventListener("DOMContentLoaded", function () {
    const update_category_id = document.getElementById('update-category-id');
    const update_category_title = document.getElementById('update-category-title');
    const existing_image = document.getElementById('existing-image');
    const update_featured_yes = document.getElementById('update-featured-yes');
    const update_featured_no = document.getElementById('update-featured-no');
    const update_available_yes = document.getElementById('update-available-yes');
    const update_available_no = document.getElementById('update-available-no');

    const delete_category_id = document.getElementById('delete-category-id');
    const delete_category_image = document.getElementById('delete-category-image');

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

                    if (buttonClass === '.table-delete-btn') {
                        const delete_item_id = this.getAttribute('data-item-id');
                        const delete_cat_image = this.getAttribute('data-image')
                        if (delete_category_id) {
                            delete_category_id.value = delete_item_id;
                        }

                        if (delete_cat_image) {
                            delete_category_image.value = delete_cat_image;
                        }
                    }

                    else if (buttonClass === '.table-update-btn') {
                        const id = this.getAttribute('data-id');
                        if (id) {
                            update_category_id.value = id;
                        }

                        const title = this.getAttribute('data-title');
                        if (title) {
                            update_category_title.value = title;
                        }
                        const image = this.getAttribute('data-image');
                        if (image) {
                            existing_image.value = image;
                        }

                        const data_featured = this.getAttribute('data-featured');
                        if (data_featured === "Yes") {
                            update_featured_yes.checked = true;
                        }
                        else {
                            update_featured_no.checked = true;
                        }

                        const data_available = this.getAttribute('data-available');
                        if (data_available === "Yes") {
                            update_available_yes.checked = true;
                        }
                        else {
                            update_available_no.checked = true;
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
    handleButtonClick(".add-new-btn", ".add-form");
    handleButtonClick(".table-update-btn", ".update-form");
    handleButtonClick(".table-delete-btn", ".delete-form");

});

 