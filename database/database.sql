-- Database creation
CREATE DATABASE IF NOT EXISTS simple_ecommerce;
USE simple_ecommerce;

-- Drop tables if they exist to avoid conflicts
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;

-- Products table
CREATE TABLE products (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Orders table
CREATE TABLE orders (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_address TEXT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Order items table
CREATE TABLE order_items (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample products
INSERT INTO products (name, description, price, image) VALUES
('Smartphone', 'Latest smartphone with high-end features and a powerful camera. This device comes with 128GB storage and 8GB RAM.', 499.99, 'smartphone.jpg'),
('Laptop', 'Powerful laptop for work and gaming with dedicated graphics card, 16GB RAM and 512GB SSD storage.', 899.99, 'laptop.jpg'),
('Headphones', 'Noise cancelling wireless headphones with 30-hour battery life and premium sound quality.', 149.99, 'headphones.jpg'),
('Smartwatch', 'Fitness tracker and smartwatch with heart rate monitoring, sleep tracking and water resistance.', 199.99, 'smartwatch.jpg'),
('Tablet', '10-inch tablet with HD display, octa-core processor and all-day battery life.', 299.99, 'tablet.jpg'),
('Camera', 'Digital camera with 4K recording, 24MP sensor and professional grade lens system.', 599.99, 'camera.jpg');