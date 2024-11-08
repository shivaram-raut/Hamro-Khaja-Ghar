
document.addEventListener("DOMContentLoaded", function () {

    const food_item_id = document.getElementById("food-item-id");
    const image_src = document.getElementById("image-src");
    const food_item = document.getElementById("food-item");
    const item_price = document.getElementById("item-price");
    const item_description = document.getElementById("item-description");
    const item_quantity = document.getElementById("item-quantity");
    const total_price = document.getElementById("total-price");
    price = 0; 


    // show login-form
    function showModal(formId){
        document.querySelector('.overlay').classList.add('show-overlay');
        document.querySelector(formId).classList.add('show-form');
     
    }
    
    
    // close login-form
    function closeModal(formId){
        document.querySelector('.overlay').classList.remove('show-overlay');
        document.querySelector(formId).classList.remove('show-form');

    }
    
    function handleButtonClick(buttonClass, formId) {
            var buttons = document.querySelectorAll(buttonClass);
            if(buttons.length > 0){
                buttons.forEach(function(btn){
                    btn.addEventListener("click", function(){
                        food_item_id.value= parseInt(this.getAttribute('data-food-item-id').trim());
                        image_src.src = this.getAttribute('data-image');
                        food_item.textContent = this.getAttribute('data-title');
                        price = parseFloat(this.getAttribute('data-price').trim()).toFixed(2);
                        item_price.textContent ="Rs. " + price ;
                        item_description.textContent = this.getAttribute('data-description');
                        item_quantity.value = 1; 
                        total_price.textContent = "Total price: Rs. " + price;



                        showModal(formId);
                    });
                });
               
            }
       
        var closeButtons = document.querySelectorAll(".cross");
    if (closeButtons.length > 0) {
        closeButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                closeModal(formId);
            });
        });
    }
    
    }

    item_quantity.addEventListener("input", function(){
        const quantity = parseInt(item_quantity.value) || 1; // default value for quantity = 1 in case of errors
        const new_total_price = (quantity * price).toFixed(2);
        total_price.textContent = "Total price: Rs. " + new_total_price;
    });

    // handleButtonClick(".login-pop-up", "#customer-login-form");
    handleButtonClick(".cart-pop-up", "#cart-box");
    
    
    });
    
    