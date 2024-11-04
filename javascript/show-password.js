 

document.addEventListener("DOMContentLoaded", function(){

    var password_btns = document.querySelectorAll(".password");
    var re_password_btns = document.querySelectorAll(".re_password");
    var check_boxes = document.querySelectorAll(".check-box");

    
    function toggle(btn){
        if (btn.type === "password") {
            btn.type = "text";
        } else {
            btn.type = "password";
        }
    }
    
    function showPassword() {
        password_btns.forEach(function(btn){
            toggle(btn);
        });

        re_password_btns.forEach(function(btn){
            toggle(btn);
        });
    }

    check_boxes.forEach(function(check_box){
        check_box.addEventListener("click", showPassword);
    });

});

