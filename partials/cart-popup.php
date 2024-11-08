<!-- cart pop-up starts here -->
<div class="overlay"> </div>
<div id="cart-box" class="form">
    <span class="cross">&times;</span>
    <form action="<?php echo SITEURL . 'customer-backend/my-cart.php'; ?>" method="post">
        <input type="hidden" name="form-id" value="cart-popup-form">
        <input type="hidden" name="redirect-uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        <input type="hidden" name="user-id" value="<?php echo $_SESSION['user-id']; ?>">
        <input type="hidden" name="food-item-id" id="food-item-id">
        <div class="popup-menu-box">

            <div class="menu-image">
                <img src="../images/menu/menu-Chicken Ham Burger 3724266e03e73bf82c.jpeg" id="image-src" class="image-responsive">
            </div>
            <div class="menu-details">
                <div id="food-item">Burger</div>
                <div id="item-price">Rs. 100</div>
                <div id="item-description"> This is burger. This burger is very tasty. You should buy this burger. </div>
            </div>
            <div>
                <label for="item-quantity">Quantity: </label>
                <input style="width:40%; height:30px;" type="number" name="item-quantity" id="item-quantity" value="1" min="1" required>
            </div>
            <div id="total-price" style="font-size: 18px; padding: 7px 0 0 7px;">
                Total price: Rs. 100
            </div>

        </div>
        <button type="submit" name="submit">Add to Cart</button>
    </form>
</div>

<!-- cart pop-up ends here -->