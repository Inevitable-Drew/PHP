<?php
session_start();

// Product catalog with prices in PHP pesos
$products = [
    1 => ['name' => 'Instant Noodles', 'price' => 17.00],
    2 => ['name' => 'Canned Sardines', 'price' => 27.00],
    3 => ['name' => 'Rice (1kg)', 'price' => 50.00],
    4 => ['name' => 'Cooking Oil (1L)', 'price' => 100.00],
    5 => ['name' => 'Eggs (per piece)', 'price' => 9.00],
    6 => ['name' => 'Softdrinks (1.5L)', 'price' => 85.00],
    7 => ['name' => 'Bread Loaf', 'price' => 50.00],
    8 => ['name' => 'Coffee 3-in-1 (sachet)', 'price' => 20.00],
    9 => ['name' => 'Shampoo (sachet)', 'price' => 15.00],
    10 => ['name' => 'Candy (per piece)', 'price' => 2.00]
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['cart'] = [];
    
    foreach ($products as $id => $product) {
        $quantity = isset($_POST['quantity'][$id]) ? (int)$_POST['quantity'][$id] : 0;
        
        if ($quantity > 0) {
            $_SESSION['cart'][$id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'subtotal' => $product['price'] * $quantity
            ];
        }
    }
    
    if (!empty($_SESSION['cart'])) {
        header('Location: cart.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sari-Sari Store</title>
        <!-- Change the CSS, para di mapansin ni sir HAHAHAHAHAHA -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            padding: 30px;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
            font-size: 2.5em;
        }
        
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-style: italic;
        }
        
        .products {
            display: grid;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .product-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            transition: transform 0.2s;
        }
        
        .product-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .product-name {
            font-weight: 600;
            color: #333;
        }
        
        .product-price {
            color: #28a745;
            font-weight: bold;
        }
        
        .quantity-input {
            width: 80px;
            padding: 8px;
            border: 2px solid #ddd;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
        }
        
        .quantity-input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        @media (max-width: 600px) {
            .product-item {
                grid-template-columns: 1fr;
                gap: 10px;
                text-align: center;
            }
            
            .quantity-input {
                margin: 0 auto;
            }
        }
    </style>
    <!-- Do not touch anything below this line. -->
</head>
<body>
    <div class="container">
        <h1>🏪 Sari-Sari Store</h1>
        <p class="subtitle">Select your items and quantities</p>
        
        <form method="POST">
            <div class="products">
                <?php foreach ($products as $id => $product): ?>
                    <div class="product-item">
                        <span class="product-name"><?php echo htmlspecialchars($product['name']); ?></span>
                        <span class="product-price">₱<?php echo number_format($product['price'], 2); ?></span>
                        <input 
                            type="number" 
                            name="quantity[<?php echo $id; ?>]" 
                            min="0" 
                            value="0" 
                            class="quantity-input"
                        >
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button type="submit" class="submit-btn">Proceed to Cart 🛒</button>
        </form>
    </div>
</body>
</html>
