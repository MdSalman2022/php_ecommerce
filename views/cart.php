<h1>Shopping Cart</h1>

<?php if (empty($cart)): ?>
    <div id="empty-cart">
        <p>Your shopping cart is empty.</p>
        <p><a href="index.php">Continue Shopping</a></p>
    </div>
<?php else: ?>
    <form action="index.php?action=update_cart" method="post">
        <table id="cart-table">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>

            <?php foreach ($cart as $item): ?>
                <tr>
                    <td>
                        <img src="assets/images/smartphone.webp" alt="<?php echo isset($item['name']) ? $item['name'] : 'Product'; ?>" width="60" height="60" style="object-fit: contain;">
                        <?php echo isset($item['name']) ? $item['name'] : 'Product'; ?>
                    </td>
                    <td>$<?php echo number_format(isset($item['price']) ? $item['price'] : 0, 2); ?></td>
                    <td>
                        <input type="number" name="quantity[<?php echo isset($item['id']) ? $item['id'] : 0; ?>]" value="<?php echo isset($item['quantity']) ? $item['quantity'] : 1; ?>" min="0" max="99">
                    </td>
                    <td>$<?php echo number_format((isset($item['price']) ? $item['price'] : 0) * (isset($item['quantity']) ? $item['quantity'] : 0), 2); ?></td>
                    <td>
                        <a href="index.php?action=remove_from_cart&id=<?php echo isset($item['id']) ? $item['id'] : 0; ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" id="cart-total-label">Total:</td>
                <td id="cart-total-amount">$<?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
        </table>

        <div id="cart-actions">
            <input type="submit" value="Update Cart">
            <a href="index.php">Continue Shopping</a>
            <a href="index.php?page=checkout">Proceed to Checkout</a>
        </div>
    </form>
<?php endif; ?>