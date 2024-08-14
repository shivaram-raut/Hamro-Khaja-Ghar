
function showModal(){
    document.querySelector('.overlay').classList.add('show-overlay');
    document.querySelector('.login-form').classList.add('show-login-form');


}

function closeModal(){
    document.querySelector('.overlay').classList.remove('show-overlay');
    document.querySelector('.login-form').classList.remove('show-login-form');


}

document.addEventListener("DOMContentLoaded", function() {
    var btnlogin = document.querySelector(".btn-login");
    btnlogin.addEventListener("click", showModal);
});

document.addEventListener("DOMContentLoaded", function() {
    var cross = document.querySelector(".cross");
    cross.addEventListener("click", closeModal);
});

