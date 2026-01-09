<?php
session_start();

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['subtotal'];
}

// Handle confirm order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    // Store date in session for receipt. 
    $_SESSION['order_date'] = date('F d, Y h:i A');
    // Generate a simple order number. 
    $_SESSION['order_number'] = 'ORD-' . strtoupper(substr(md5(time()), 0, 8));
    header('Location: receipt.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Your Order - Sari-Sari Store</title>
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
        }
        
        .cart-items {
            margin-bottom: 30px;
        }
        
        .cart-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            padding: 15px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }
        
        .cart-item:first-child {
            background: #f8f9fa;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        
        .item-name {
            color: #333;
        }
        
        .item-price, .item-quantity, .item-subtotal {
            text-align: center;
        }
        
        .total-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
        }
        
        .total-amount {
            color: #28a745;
        }
        
        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .btn {
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            text-align: center;
            display: block;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn-back {
            background: #6c757d;
            color: white;
        }
        
        .btn-confirm {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }
        
        @media (max-width: 600px) {
            .cart-item {
                grid-template-columns: 1fr;
                gap: 5px;
            }
            
            .item-price, .item-quantity, .item-subtotal {
                text-align: left;
            }
            
            .button-group {
                grid-template-columns: 1fr;
            }
        }
        
    </style>
    <!-- Do not touch anything below this line. -->
</head>
<body>
    <div class="container">
        <h1>🛒 Review Your Order</h1>
        <p class="subtitle">Please check your items before confirming</p>
        
        <div class="cart-items">
            <div class="cart-item">
                <span>Item</span>
                <span class="item-price">Price</span>
                <span class="item-quantity">Qty</span>
                <span class="item-subtotal">Subtotal</span>
            </div>
            
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="cart-item">
                    <span class="item-name"><?php echo htmlspecialchars($item['name']); ?></span>
                    <span class="item-price">₱<?php echo number_format($item['price'], 2); ?></span>
                    <span class="item-quantity"><?php echo $item['quantity']; ?></span>
                    <span class="item-subtotal">₱<?php echo number_format($item['subtotal'], 2); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="total-section">
            <div class="total-row">
                <span>Total Amount:</span>
                <span class="total-amount">₱<?php echo number_format($total, 2); ?></span>
            </div>
        </div>
        
        <div class="button-group">
            <a href="index.php" class="btn btn-back">← Back to Store</a>
            <form method="POST" style="margin: 0;">
                <button type="submit" name="confirm" class="btn btn-confirm">Confirm Order ✓</button>
            </form>
        </div>
    </div>
</body>
</html>
