<?php
require_once 'controllers/BaseController.php';
require_once 'models/CartModel.php';
require_once 'models/OrderModel.php';

class CheckoutController extends BaseController
{
    private $cartModel;
    private $orderModel;

    public function __construct()
    {
        parent::__construct();
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel($this->conn);
    }

    public function checkout()
    {
        $cart = $this->cartModel->getCart();
        $total = $this->cartModel->calculateTotal();
        $cartCount = $this->cartModel->getCartCount();

        $this->render('checkout', [
            'cart' => $cart,
            'total' => $total,
            'cartCount' => $cartCount
        ]);
    }

    public function processOrder()
    {
        // Validate input
        $customerName = $_POST['customer_name'] ?? '';
        $customerPhone = $_POST['customer_phone'] ?? '';
        $customerAddress = $_POST['customer_address'] ?? '';

        if (empty($customerName) || empty($customerPhone) || empty($customerAddress)) {
            return $this->renderError("Please fill all required fields", "index.php?page=checkout");
        }

        $cart = $this->cartModel->getCart();

        // If cart is empty, redirect back
        if (empty($cart)) {
            return $this->renderError("Your cart is empty", "index.php");
        }

        try {
            // Calculate total
            $total = $this->cartModel->calculateTotal();

            // Create order
            $orderId = $this->orderModel->createOrder($customerName, $customerPhone, $customerAddress, $total);

            // Add order items
            $errorCount = 0;
            foreach ($cart as $item) {
                if (isset($item['id']) && !empty($item['id'])) {
                    $productId = $item['id'];
                    $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
                    $price = isset($item['price']) ? $item['price'] : 0;

                    $success = $this->orderModel->addOrderItem($orderId, $productId, $quantity, $price);
                    if (!$success) {
                        $errorCount++;
                    }
                }
            }

            if ($errorCount > 0) {
                // Log error but continue, as the main order was created
                error_log("Failed to add {$errorCount} items to order {$orderId}");
            }

            // Clear cart
            $this->cartModel->clearCart();

            // Set success message
            $_SESSION['message'] = "Order placed successfully!";

            // Redirect to home
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            return $this->renderError("Error processing your order: " . $e->getMessage(), "index.php?page=checkout");
        }
    }
}
