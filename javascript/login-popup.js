
document.addEventListener("DOMContentLoaded", function () {

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

    handleButtonClick(".login-pop-up", "#customer-login-form");
    });
    
    