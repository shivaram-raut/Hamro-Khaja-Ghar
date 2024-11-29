document.addEventListener("DOMContentLoaded", function(){

   const update_status_form_id= document.getElementById("update-status-form");
   const generate_invoice_form_id = document.getElementById("generate-invoice-form");
   const update_status_btn = document.getElementById("update-status-btn");
   const order_status_input = document.getElementById("order-status");
   const print_invoice_btn = document.getElementById("print-invoice-btn"); // will work on this later
    const go_back_btn = document.getElementById("go-back-btn");

  

    if(update_status_btn){

        if(order_status_input){
            order_status_input.addEventListener("input", function(){
                update_status_btn.classList.add("btn-hover");
            });
        }

        update_status_btn.addEventListener("click", function(){
            update_status_form_id.submit();
        });
    }

    if(go_back_btn){
        go_back_btn.addEventListener("click", function(){
            window.history.back();
        });
    }

    if(print_invoice_btn){
        print_invoice_btn.addEventListener("click", function(){
            generate_invoice_form_id.submit();
        });
    }


});