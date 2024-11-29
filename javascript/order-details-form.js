document.addEventListener("DOMContentLoaded", function(){

    const form_id = document.getElementById('order-details-form');
    const user_id = document.getElementById('user-id');
    const order_id = document.getElementById('order-id');
    const delivery_adrs = document.getElementById('delivery-adrs');
    const order_status = document.getElementById('order-status');
    const order_date = document.getElementById("order-date");

    var buttons = document.querySelectorAll('.view-details-btn');

    if(buttons.length > 0){
        buttons.forEach(function(button){
            button.addEventListener("click", function(){
                user_id.value = parseInt(this.getAttribute('data-user-id').trim());
                order_id.value = this.getAttribute('data-order-id');
                delivery_adrs.value = this.getAttribute('data-delivery-adrs');
                order_status.value = this.getAttribute('data-order-status');
                order_date.value = this.getAttribute('data-order-date');

                form_id.submit();

            });
        });
    }
});