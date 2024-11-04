 

document.addEventListener("DOMContentLoaded", function () {
    const categoryItems = document.querySelectorAll(".category-list li");
    const foodItems = document.querySelectorAll(".food-item");

    function filterItems(selectedCategory) {
        // Show/Hide food items based on the selected category
        foodItems.forEach(foodItem => {
            if (foodItem.getAttribute("data-category") === selectedCategory || selectedCategory === "all") {
                foodItem.style.display = "block"; // Show matching items
            } else {
                foodItem.style.display = "none"; // Hide non-matching items
            }
        });

        // Highlight the selected category
        categoryItems.forEach(category => category.classList.remove("active-menu"));
        const activeCategory = Array.from(categoryItems).find(category => category.getAttribute("data-category") === selectedCategory);
        if (activeCategory) {
            activeCategory.classList.add("active-menu");
        }
    }

    // Check URL parameters and filter items on page load
    const urlParams = new URLSearchParams(window.location.search);
    const url_category = urlParams.get('category');

    if (url_category) {
        filterItems(url_category); // Filter based on URL parameter
    }

    // Add event listeners for category items
    categoryItems.forEach(item => {
        item.addEventListener("click", function () {
            // Get the selected category from the clicked element
            const selectedCategory = this.getAttribute("data-category");

            // reload the page with selectedCategory as query parameter
            window.location.href = `${window.location.pathname}?category=${selectedCategory}`;

        });
    });
});
