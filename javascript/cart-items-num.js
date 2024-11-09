document.addEventListener("DOMContentLoaded", function () {
    // Retrieve the previous cart count from localStorage (if available)
    const previousCartCount = localStorage.getItem('previousCartCount') || 0;
    document.getElementById('cart-items-count').textContent = previousCartCount;


    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../customer-backend/cart-items-num.php', true);
    xhr.onload = function () {
        if (this.status === 200) {

            // Get the new cart count from the server
            const currentCartCount = this.responseText;


            if (previousCartCount !== currentCartCount) {
                // Update the cart count in the navigation bar
                document.getElementById('cart-items-count').textContent = currentCartCount;

                // Save the new cart count to localStorage
                localStorage.setItem('previousCartCount', currentCartCount);
            }
        }
    };
    xhr.send();

});