document.addEventListener("DOMContentLoaded", function () {

// show login-form
function showModal(formId, errorMessage = null){
    document.querySelector('.overlay').classList.add('show-overlay');
    document.querySelector(formId).classList.add('show-form');

    if (errorMessage) {
        document.getElementById("error-msg").innerText = errorMessage;
    }
}


// close login-form
function closeModal(formId){
    document.querySelector('.overlay').classList.remove('show-overlay');
    document.querySelector(formId).classList.remove('show-form');
    document.getElementById("error-msg").innerText = "";


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

const urlParams = new URLSearchParams(window.location.search);
const errorMessage = urlParams.get('error');
const formId = "#" + urlParams.get('show');

if (errorMessage && formId) {
    showModal(formId, errorMessage);
}
 
 
 handleButtonClick("#admin-login-btn","#admin-login-form");
 handleButtonClick("#employee-login-btn","#admin-login-form");
 handleButtonClick("#customer-login-btn","#customer-login-form");
 handleButtonClick("#login-btn", "#customer-login-form");
 

});
