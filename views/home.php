<h1>Our Products</h1>

<div id="products">
    <?php if (empty($products)): ?>
        <p>No products available.</p>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="assets/images/smartphone.webp" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                <p><?php echo substr($product['description'], 0, 100) . (strlen($product['description']) > 100 ? '...' : ''); ?></p>
                <div>
                    <a href="index.php?page=product&id=<?php echo $product['id']; ?>">View Details</a>
                    <a href="index.php?action=add_to_cart&id=<?php echo $product['id']; ?>">Add to Cart</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>