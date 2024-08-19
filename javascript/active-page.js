document.addEventListener('DOMContentLoaded', () => {
    const currentLocation = window.location.pathname;
    const menuItems = document.querySelectorAll('.navigation-bar .menu ul li a');

    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentLocation.split('/').pop()) {
            item.parentElement.classList.add('active');
        }
    });
});