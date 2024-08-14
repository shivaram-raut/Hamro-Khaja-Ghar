
function showModal(){
    document.querySelector('.overlay').classList.add('show-overlay');
    document.querySelector('.add-employee-form').classList.add('show-add-employee-form');


}

function closeModal(){
    document.querySelector('.overlay').classList.remove('show-overlay');
    document.querySelector('.add-employee-form').classList.remove('show-add-employee-form');


}

document.addEventListener("DOMContentLoaded", function() {
    var btnlogin = document.querySelector(".add-employee");
    btnlogin.addEventListener("click", showModal);
});

document.addEventListener("DOMContentLoaded", function() {
    var cross = document.querySelector(".cross");
    cross.addEventListener("click", closeModal);
});

