function showNotification(){
    document.querySelector('.notification-msg').classList.add('show-notification-msg');

}


function closeNotification(){
    document.querySelector('.notification-msg').classList.remove('show-notification-msg');
   
 
}

document.addEventListener("DOMContentLoaded", function() {
    //  showNotification();
    setTimeout(function() {
     showNotification();
    }, 100);
});

document.addEventListener("DOMContentLoaded", function() {
    var cross = document.querySelector(".cross1");
    var close = document.querySelector(".notification-msg");
    

    cross.addEventListener("click", closeNotification);
    window.addEventListener("scroll", closeNotification);

    close.addEventListener("click", closeNotification);
});