 

document.addEventListener("DOMContentLoaded", function () {
    const update_form = document.getElementById("update-cart-quantity-form");
    const form_food_item_id = document.getElementById("update-food-item-id");
    const form_quantity = document.getElementById("quantity");

    let corresponding_quantity;
    let quantity;
    let food_item_id;

    // Handle the update button functionality
    const updateButtons = document.querySelectorAll(".table-update-btn");

    if (updateButtons.length > 0) {
        updateButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                food_item_id = parseInt(this.getAttribute('data-food-item-id'));

                // Find the corresponding quantity input field
                corresponding_quantity = document.querySelector(`.item-quantity[data-food-item-id="${food_item_id}"]`);

                if (corresponding_quantity) {
                    quantity = parseInt(corresponding_quantity.value.trim());

                    // Set the hidden form fields
                    form_food_item_id.value = food_item_id;
                    form_quantity.value = quantity;

                    // Submit the form
                    update_form.submit();
                }
            });
        });
    }

    // Handle dynamic price calculation on quantity change
    const quantityInputs = document.querySelectorAll(".item-quantity");

    if (quantityInputs.length > 0) {
        quantityInputs.forEach(function (input) {
            input.addEventListener("input", function () {

                const food_item_id = this.getAttribute('data-food-item-id');

                 document.querySelector(`.table-update-btn[data-food-item-id="${food_item_id}"]`).classList.add('add-background');
                const corresponding_total = document.querySelector(`.total-price[data-food-item-id="${food_item_id}"]`);
                
                const unit_price = parseInt(corresponding_total.getAttribute('data-unit-price').trim());
                

                const new_quantity = parseInt(this.value.trim());

                // Update the total price for the specific item
                if (!isNaN(new_quantity) && new_quantity > 0) {
                    const new_total_price = unit_price * new_quantity;
                    corresponding_total.textContent = `Rs. ${new_total_price.toFixed(2)}`;
                }

                // Update the grand total
                updateGrandTotal();
            });
        });
    }

    // Function to update the grand total
    function updateGrandTotal() {
        let grandTotal = 0;
        const allTotalPrices = document.querySelectorAll(".total-price");
        allTotalPrices.forEach(function (priceElement) {
            const price = parseFloat(priceElement.textContent.replace("Rs.", "").trim());
            grandTotal += price;
        });
        const grandTotalElement = document.querySelector(".grand-total-row:last-child");
        grandTotalElement.textContent = `Rs. ${grandTotal.toFixed(2)}`;
    }
});
 