<?php
// Database connection singleton
if (!function_exists('getDbConnection')) {
    function getDbConnection() {
        static $conn = null;
        
        if ($conn === null) {
            // Database credentials
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $dbname = 'simple_ecommerce';

            // Create connection
            $conn = new mysqli($host, $user, $pass, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }
        
        return $conn;
    }
}

// Return the connection
return getDbConnection();
