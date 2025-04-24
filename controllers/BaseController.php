<?php

class BaseController
{
    protected $conn;

    public function __construct()
    {
        // Get database connection - include only once across the application
        $this->conn = require 'config/database.php';
        
        // Verify we have a valid connection
        if (!$this->conn || $this->conn === true) {
            die("Error: Database connection failed");
        }
    }

    protected function render($view, $data = [])
    {
        // Extract data variables
        extract($data);

        // Include header
        include 'views/header.php';

        // Include the view
        include "views/$view.php";

        // Include footer
        include 'views/footer.php';
    }

    protected function renderError($errorMessage, $backUrl = null)
    {
        $this->render('error', [
            'errorMessage' => $errorMessage,
            'backUrl' => $backUrl,
            'cartCount' => 0 // Ensure we have a cartCount for header
        ]);
        exit;
    }
}
