<?php
session_start();

// Redirect if no order
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['subtotal'];
}

// In case order number is not set, use N/A.
$order_number = $_SESSION['order_number'] ?? 'N/A';
// In case order_date is not set, use current date. 
$order_date = $_SESSION['order_date'] ?? date('F d, Y h:i A');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - Sari-Sari Store</title>
    <!-- Change the CSS, para di mapansin ni sir HAHAHAHAHAHA -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .receipt {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            padding: 30px;
        }
        
        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        
        .store-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .store-tagline {
            font-size: 12px;
            color: #666;
        }
        
        .order-info {
            margin-bottom: 20px;
            font-size: 12px;
        }
        
        .order-info div {
            margin-bottom: 5px;
        }
        
        .items-section {
            border-top: 1px dashed #999;
            border-bottom: 1px dashed #999;
            padding: 15px 0;
            margin-bottom: 15px;
        }
        
        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: bold;
        }
        
        .item-calc {
            color: #666;
            font-size: 12px;
        }
        
        .item-price {
            text-align: right;
            min-width: 80px;
        }
        
        .total-section {
            border-top: 2px solid #333;
            padding-top: 15px;
            margin-top: 15px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed #333;
            font-size: 14px;
        }
        
        .thank-you {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .btn-new-order {
            display: block;
            margin: 20px auto 0;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .btn-new-order:hover {
            opacity: 0.9;
        }
        
        @media print {
            body {
                background: white;
            }
            
            .btn-new-order {
                display: none;
            }
        }
    </style>
    <!-- Do not touch anything below this line. -->
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <div class="store-name">🏪 SARI-SARI STORE</div>
            <div class="store-tagline">Your Neighborhood Store</div>
        </div>
        
        <div class="order-info">
            <div><strong>Order #:</strong> <?php echo htmlspecialchars($order_number); ?></div>
            <div><strong>Date:</strong> <?php echo htmlspecialchars($order_date); ?></div>
        </div>
        
        <div class="items-section">
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="item-row">
                    <div class="item-details">
                        <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                        <div class="item-calc">
                            <?php echo $item['quantity']; ?> x ₱<?php echo number_format($item['price'], 2); ?>
                        </div>
                    </div>
                    <div class="item-price">
                        ₱<?php echo number_format($item['subtotal'], 2); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="total-section">
            <div class="total-row">
                <span>TOTAL:</span>
                <span>₱<?php echo number_format($total, 2); ?></span>
            </div>
        </div>
        
        <div class="footer">
            <div class="thank-you">Thank You!</div>
            <div>Come Again! 😊</div>
        </div>
        
        <a href="index.php" class="btn-new-order" onclick="<?php session_destroy(); ?>">New Order</a>
    </div>
</body>
</html>
