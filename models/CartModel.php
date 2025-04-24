<?php

class CartModel
{
    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }

    public function getCart()
    {
        return $_SESSION['cart'];
    }

    public function addToCart($product)
    {
        // Check if product already in cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product['id']) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }

        // Add product to cart if not found
        if (!$found) {
            $_SESSION['cart'][] = array(
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1
            );
        }
    }

    public function removeFromCart($productId)
    {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $productId) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }

        // Reindex array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    public function updateCart($quantityArray)
    {
        foreach ($quantityArray as $id => $quantity) {
            if ($quantity > 0) {
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] == $id) {
                        $item['quantity'] = $quantity;
                        break;
                    }
                }
            } else {
                $this->removeFromCart($id);
            }
        }
    }

    public function clearCart()
    {
        $_SESSION['cart'] = array();
    }

    public function calculateTotal()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $price = isset($item['price']) ? $item['price'] : 0;
            $quantity = isset($item['quantity']) ? $item['quantity'] : 0;
            $total += $price * $quantity;
        }
        return $total;
    }

    public function getCartCount()
    {
        $count = 0;
        foreach ($_SESSION['cart'] as $item) {
            $count += isset($item['quantity']) ? $item['quantity'] : 0;
        }
        return $count;
    }
}
