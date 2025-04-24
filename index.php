<?php
// Start session for cart
session_start();

// Autoload classes
function autoloader($class)
{
    // Try to load from models directory
    if (file_exists("models/{$class}.php")) {
        require_once "models/{$class}.php";
    }
    // Try to load from controllers directory
    else if (file_exists("controllers/{$class}.php")) {
        require_once "controllers/{$class}.php";
    }
}

spl_autoload_register('autoloader');

// Database connection
$conn = require_once 'config/database.php';

// Simple routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Process actions and route to controllers
if (!empty($action)) {
    // Product actions
    if ($action == 'add_to_cart' && isset($_GET['id'])) {
        $productController = new ProductController($conn);
        $productController->addToCart($_GET['id']);
    }

    // Cart actions
    else if ($action == 'remove_from_cart' && isset($_GET['id'])) {
        $cartController = new CartController();
        $cartController->removeFromCart($_GET['id']);
    } else if ($action == 'update_cart') {
        $cartController = new CartController();
        $cartController->updateCart();
    }

    // Checkout actions
    else if ($action == 'process_order') {
        $checkoutController = new CheckoutController();
        $checkoutController->processOrder();
    }
}

// Route to appropriate controller based on page
switch ($page) {
    case 'home':
        $controller = new ProductController($conn);
        $controller->index();
        break;
    case 'product':
        $controller = new ProductController($conn);
        $controller->viewProduct($_GET['id'] ?? 0);
        break;
    case 'cart':
        $controller = new CartController();
        $controller->viewCart();
        break;
    case 'checkout':
        $controller = new CheckoutController();
        $controller->checkout();
        break;
    default:
        $controller = new ProductController($conn);
        $controller->index();
        break;
}

// Close database connection
$conn->close();
