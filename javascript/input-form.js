document.addEventListener("DOMContentLoaded", function () {
    errorMsgDivs = document.querySelectorAll(".error-msg");
    // show login-form
    function showModal(formId, errorMessage = null) {
        document.querySelector('.overlay').classList.add('show-overlay');
        document.querySelector(formId).classList.add('show-form');

        if (errorMessage) {
            if (errorMsgDivs.length > 0) {
                // Using setTimeout to add a delay before displaying the error message
                setTimeout(function() {
                    errorMsgDivs.forEach(function(div) {
                        div.innerText = errorMessage;
                    });
                }, 400);
            }

        }
    }


    // close login-form
    function closeModal(formId) {
        document.querySelector('.overlay').classList.remove('show-overlay');
        document.querySelector(formId).classList.remove('show-form');
        if (errorMsgDivs.length > 0) {
            errorMsgDivs.forEach(function (div) {
                div.innerText = "";
            });
        }


    }

    function handleButtonClick(button, formId) {
        var btn = document.querySelector(button);
        if (btn) {
            btn.addEventListener("click", function () {
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
    formId =  urlParams.get('show');

    if (errorMessage && formId) {
        formId= "#" + formId;
        showModal(formId, errorMessage);
    }
    else if(formId){
        formId= "#" + formId;
        showModal(formId);
    }


    handleButtonClick("#admin-login-btn", "#admin-login-form");
    handleButtonClick("#employee-login-btn", "#employee-login-form");
    handleButtonClick("#customer-login-btn", "#customer-login-form");
    handleButtonClick("#login-btn", "#customer-login-form");



});
