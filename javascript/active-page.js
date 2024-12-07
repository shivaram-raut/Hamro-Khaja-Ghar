document.addEventListener('DOMContentLoaded', () => {
    const currentLocation = window.location.pathname;
    const menuItems = document.querySelectorAll('.navigation-bar .menu ul li a');

    menuItems.forEach(item => {
        var active_page = item.getAttribute('href');
        if (active_page === currentLocation.split('/').pop()) {
            if(active_page === 'my-cart.php'){
                document.getElementById("cart-items-count").style.display = "none";
            }
            item.parentElement.classList.add('active');
        }
    });
});