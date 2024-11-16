 

document.addEventListener("DOMContentLoaded", function () {
    const categoryItems = document.querySelectorAll(".category-list li");
    const foodItems = document.querySelectorAll(".food-item");

    const search_food_form = document.getElementById('search-food-form');
    const searched_food_input = document.getElementById('searched-food');

    const form = document.querySelector("form"); // Select the form element
    const redirectUriInput = document.getElementById('redirect-uri');  // Select the redirect-uri input


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

    function updateRedirectUri() {
        if (redirectUriInput) {
            redirectUriInput.value = window.location.href; // Update with full current URL
        }
    }

    // Check URL parameters and filter items on page load
    const urlParams = new URLSearchParams(window.location.search);
    const url_category = urlParams.get('category') || 'all';

    updateRedirectUri(); // Update the hidden input on page load

    const url_searched_food = urlParams.get('searched-food');

    // const form_submit_count = localStorage.getItem('form-submit-count') || 0;

    if (url_searched_food) {

        searched_food_input.value = url_searched_food;

        var search_present = true;

        // if (form_submit_count == 0) {
        //     localStorage.setItem('form-submit-count', 1);
        //     search_food_form.submit();
        //     return;
        // }
        
    }

    else if (url_category) {
        filterItems(url_category); // Filter based on URL parameter
    }

    // Add event listeners for category items
    categoryItems.forEach(item => {
        item.addEventListener("click", function () {

            // Get the selected category from the clicked element
            const selectedCategory = this.getAttribute("data-category");

            // reload the page with selectedCategory as query parameter
            if (selectedCategory === 'all') {
                window.location.href = `${window.location.pathname}?category=${selectedCategory}`;

            }

            else {
                if (search_present) {
                    window.location.href = `${window.location.pathname}?category=${selectedCategory}`;
                    localStorage.setItem('form-submit-count', 0);
                    search_present = false;

                }
                filterItems(selectedCategory); // Filter items in-place
                history.pushState(null, '', `${window.location.pathname}?category=${selectedCategory}`);
                updateRedirectUri();


            }

        });
    });

    // Ensure the redirect-uri is updated right before submitting the form
    form.addEventListener("submit", function () {
        updateRedirectUri();
    });
    // localStorage.setItem('form-submit-count', 0);

});


