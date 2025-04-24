<h1>Checkout</h1>

<?php if (empty($cart)): ?>
    <div id="empty-cart">
        <p>Your shopping cart is empty. You cannot proceed to checkout.</p>
        <p><a href="index.php">Go to Products</a></p>
    </div>
<?php else: ?>
    <div id="checkout-container">
        <div id="checkout-form">
            <h2>Shipping Information</h2>
            <form action="index.php?action=process_order" method="post">
                <div>
                    <label for="customer_name">Full Name:</label>
                    <input type="text" id="customer_name" name="customer_name" required>
                </div>

                <div>
                    <label for="customer_phone">Phone Number:</label>
                    <input type="tel" id="customer_phone" name="customer_phone" required>
                </div>

                <div>
                    <label for="customer_address">Delivery Address:</label>
                    <textarea id="customer_address" name="customer_address" rows="3" required></textarea>
                </div>

                <div id="checkout-actions">
                    <a href="index.php?page=cart">Back to Cart</a>
                    <input type="submit" value="Confirm Order">
                </div>
            </form>
        </div>

        <div id="order-summary">
            <h2>Order Summary</h2>
            <?php foreach ($cart as $item): ?>
                <div class="order-item">
                    <img src="assets/images/smartphone.webp" alt="<?php echo isset($item['name']) ? $item['name'] : 'Product'; ?>" width="50" height="50" style="object-fit: contain;">
                    <span><?php echo isset($item['name']) ? $item['name'] : 'Product'; ?> x <?php echo isset($item['quantity']) ? $item['quantity'] : 0; ?></span>
                    <span>$<?php echo number_format((isset($item['price']) ? $item['price'] : 0) * (isset($item['quantity']) ? $item['quantity'] : 0), 2); ?></span>
                </div>
            <?php endforeach; ?>

            <div id="order-total">
                <strong>Total: $<?php echo number_format($total, 2); ?></strong>
            </div>
        </div>
    </div>
<?php endif; ?>