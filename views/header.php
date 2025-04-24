<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple E-commerce</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1><a href="index.php">SimpleShop</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?page=cart">Cart
                        <?php
                        echo isset($cartCount) && $cartCount > 0 ? "($cartCount)" : "";
                        ?>
                    </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message success">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']); 
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']); 
                ?>
            </div>
        <?php endif; ?>