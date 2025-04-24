<?php

class OrderModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createOrder($customerName, $customerPhone, $customerAddress, $totalAmount)
    {
        $stmt = $this->conn->prepare("INSERT INTO orders (customer_name, customer_phone, customer_address, total_amount) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $customerName, $customerPhone, $customerAddress, $totalAmount);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function addOrderItem($orderId, $productId, $quantity, $price)
    {
        $stmt = $this->conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $orderId, $productId, $quantity, $price);
        return $stmt->execute();
    }
}
