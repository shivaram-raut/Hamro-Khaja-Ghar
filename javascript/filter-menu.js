 
document.addEventListener("DOMContentLoaded", function () {
    const categoryItems = document.querySelectorAll(".category-list li");
    const foodItems = document.querySelectorAll(".food-item");
    const form = document.querySelector("form"); // Select the form element
    const redirectUriInput = document.getElementById('redirect-uri');  // Select the redirect-uri input

    function filterItems(selectedCategory) {
        foodItems.forEach(foodItem => {
            if (foodItem.getAttribute("data-category") === selectedCategory || selectedCategory === "all") {
                foodItem.style.display = "block"; // Show matching items
            } else {
                foodItem.style.display = "none"; // Hide non-matching items
            }
        });

        categoryItems.forEach(category => category.classList.remove("active-menu"));
        const activeCategory = Array.from(categoryItems).find(category => category.getAttribute("data-category") === selectedCategory);
        if (activeCategory) {
            activeCategory.classList.add("active-menu");
        }
    }

    // Function to update the hidden input with the current URL
    function updateRedirectUri() {
        if (redirectUriInput) {
            redirectUriInput.value = window.location.href; // Update with full current URL
        }
    }

    // Check URL parameters on page load and apply the filter
    const urlParams = new URLSearchParams(window.location.search);
    const url_category = urlParams.get('category') || 'all';
    filterItems(url_category);
    updateRedirectUri(); // Update the hidden input on page load

    // Add event listeners for category items
    categoryItems.forEach(item => {
        item.addEventListener("click", function () {
            const selectedCategory = this.getAttribute("data-category");
            filterItems(selectedCategory); // Filter items in-place
            
            // Update the URL with the selected category
            history.pushState(null, '', `${window.location.pathname}?category=${selectedCategory}`);

            // Update the hidden input field with the new URL
            updateRedirectUri();
        });
    });

    // Ensure the redirect-uri is updated right before submitting the form
    form.addEventListener("submit", function () {
        updateRedirectUri();
    });
});
