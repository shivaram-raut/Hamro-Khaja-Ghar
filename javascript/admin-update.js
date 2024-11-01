document.addEventListener("DOMContentLoaded", function () {

    // show login-form
    function showModal(formId ){
        document.querySelector('.overlay').classList.add('show-overlay');
        document.querySelector(formId).classList.add('show-form');
    
    }
    
    
    // close login-form
    function closeModal(formId){
        document.querySelector('.overlay').classList.remove('show-overlay');
        document.querySelector(formId).classList.remove('show-form');
    
    
    }
    
    function handleButtonClick(button, formId) {
        var btn = document.querySelector(button);
        if(btn){
            btn.addEventListener("click", function() {
                showModal(formId);
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
     handleButtonClick("#admin-update-btn","#admin-update-form");
    
    
    });
    