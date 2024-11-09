document.addEventListener("DOMContentLoaded", function(){
    
    const form_id = document.getElementById("remove-cart-item-form");
    const food_item_id = document.getElementById("food-item-id");

    var buttons = document.querySelectorAll(".table-delete-btn");

    if(buttons.length > 0){
        buttons.forEach(function(button){
            button.addEventListener("click", function(){
                food_item_id.value = parseInt(this.getAttribute('data-food-item-id').trim());

                //submit the form
                form_id.submit() ;

            });
        });
    }

});