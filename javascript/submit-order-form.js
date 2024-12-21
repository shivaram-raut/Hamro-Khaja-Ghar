document.addEventListener("DOMContentLoaded", function(){

    const order_button = document.getElementById("confirm-order");
    const order_id = document.getElementById("order-id");
    const delivery_location = document.getElementById("delivery-location");
    const input_address = document.getElementById("address");

    function generateOrderId() {
        const timestamp = Date.now().toString().slice(-3); 
        const randomNum = Math.floor(Math.random() * 40) ; 
        return `ORD-${timestamp}${randomNum}`;
    }
    
    // console.log(orderId);
    if(order_button){

        order_button.addEventListener("click", function(){
            order = generateOrderId();
            order_id.value = order;
            
            delivery_location.value = input_address.value;

        });
    }

});