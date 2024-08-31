

document.addEventListener("DOMContentLoaded", function () {
    const update_food_id = document.getElementById('update-food-id');
    const update_food_title = document.getElementById('update-food-title');
    const update_food_price = document.getElementById('update-food-price');
    const existing_image = document.getElementById('existing-image');
    const food_category_id = document.getElementById('food-category-id');
    const update_food_description = document.getElementById('update-food-description');
    const update_featured_yes = document.getElementById('update-featured-yes');
    const update_featured_no = document.getElementById('update-featured-no');
    const update_available_yes = document.getElementById('update-available-yes');
    const update_available_no = document.getElementById('update-available-no');

    const delete_food_id = document.getElementById('delete-food-id');
    const delete_food_image = document.getElementById('delete-food-image');






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
                        const food_id = this.getAttribute('data-item-id');
                        const food_image = this.getAttribute('data-image')
                        if (food_id) {
                            delete_food_id.value = food_id;
                        }

                        if (food_image) {
                            delete_food_image.value = food_image;
                        }
                    }

                    else if (buttonClass === '.table-update-btn') {
                        const id = this.getAttribute('data-id');
                        if (id) {
                            update_food_id.value = id;
                        }

                        const title = this.getAttribute('data-title');
                        if (title) {
                            update_food_title.value = title;
                        }
            
                        const price = parseFloat(this.getAttribute('data-price').trim());
                        update_food_price.value = price;

                        const image = this.getAttribute('data-image');
                        if (image) {
                            existing_image.value = image;
                        }

                        const food_description = this.getAttribute('data-description');
                        if(food_description){
                            update_food_description.value = food_description;
                        }

                        const category = this.getAttribute('data-category').trim(); 
                        food_category_id.value = category;

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

 