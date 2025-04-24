<?php

class ProductModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;

        // Validate connection
        if (!$this->conn || !($this->conn instanceof mysqli)) {
            throw new Exception("Invalid database connection provided to ProductModel");
        }
    }

    public function getAllProducts()
    {
        try {
            $result = $this->conn->query("SELECT * FROM products ORDER BY id DESC");
            if ($result === false) {
                throw new Exception("Database query failed: " . $this->conn->error);
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("Error in getAllProducts: " . $e->getMessage());
            return [];
        }
    }

    public function getProductById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
            if ($stmt === false) {
                throw new Exception("Prepare statement failed: " . $this->conn->error);
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error in getProductById: " . $e->getMessage());
            return null;
        }
    }
}
