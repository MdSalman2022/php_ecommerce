<div id="product-detail">
    <div id="product-image">
        <img src="assets/images/smartphone.webp" alt="<?php echo $product['name']; ?>">
    </div>
    <div id="product-info">
        <h1><?php echo $product['name']; ?></h1>
        <p id="product-price">$<?php echo number_format($product['price'], 2); ?></p>
        <div id="product-description">
            <p><?php echo $product['description']; ?></p>
        </div>
        <div id="product-actions">
            <a href="index.php?action=add_to_cart&id=<?php echo $product['id']; ?>">Add to Cart</a>
            <a href="index.php">Back to Products</a>
        </div>
    </div>
</div>