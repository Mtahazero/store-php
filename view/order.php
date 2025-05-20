<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNow - E-commerce</title>   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <meta name="theme-color" content="#ff6b6b">
    <style>
        /* Product page styles scoped to avoid conflicts */
        .shop-container {
            padding: 20px 5%;
            margin-top: 80px; /* Space for fixed navbar */
            margin-bottom: 60px; /* Space for footer */
        }
        .shop-container h1, .shop-container h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .order-icon {
            display: inline-flex;
            align-items: center;
            margin: 15px;
            padding: 10px 20px;
            background-color: #ff6b6b;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }
        .order-icon i {
            margin-right: 8px;
        }
        .order-icon:hover, .order-icon:focus {
            background-color: #e55a5a;
            outline: none;
        }
        #order-form {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .cart-summary {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 6px;
            display: none;
        }
        .cart-summary ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .cart-summary li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 5px rgba(255,107,107,0.3);
        }
        .form-group.valid input, .form-group.valid select, .form-group.valid textarea {
            border-color: #2ecc71;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%232ecc71" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>') no-repeat right 10px center;
        }
        .form-group .error {
            color: #ff6b6b;
            font-size: 0.85em;
            margin-top: 5px;
            display: none;
        }
        .form-group.invalid .error {
            display: block;
        }
        .form-group.invalid input, .form-group.invalid select, .form-group.invalid textarea {
            border-color: #ff6b6b;
        }
        #order-form button {
            width: 100%;
            padding: 12px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }
        #order-form button:hover, #order-form button:focus {
            background-color: #27ae60;
            outline: none;
        }
        #order-form button:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
        }
        .total-price {
            font-size: 1.2em;
            margin-bottom: 20px;
            text-align: right;
        }
        .error-summary {
            color: #ff6b6b;
            margin-bottom: 20px;
            display: none;
            border: 1px solid #ff6b6b;
            padding: 10px;
            border-radius: 6px;
        }
        .error-summary ul {
            margin: 0;
            padding-left: 20px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            animation: slideIn 0.3s ease;
        }
        .modal-content h3 {
            margin-top: 0;
        }
        .modal-content button {
            margin-top: 20px;
            width: auto;
            padding: 10px 20px;
            background-color: #ff6b6b;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
        }
        .modal-content button:hover {
            background-color: #e55a5a;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
            .product-card img {
                height: 180px;
            }
            #order-form {
                padding: 20px;
            }
            .filter-bar {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <?php  
        include('../public/nav.php');
    ?>
    
    <div class="shop-container">

        <h2 id="order-form-title">Place Your Order</h2>
        <form id="order-form" role="form" aria-labelledby="order-form-title" >
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required >
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required >
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required >
            </div>

            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea id="address" name="address" rows="4" placeholder="Enter your shipping address" required ></textarea>
            </div>

            <div class="form-group">
                <label for="payment">Payment Method</label>
                <select id="payment" name="payment" required aria-required="true">
                    <option value="" disabled selected>Select payment method</option>
                    <option value="credit">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank">Bank Transfer</option>
                </select>
                <div class="error" id="payment-error">Please select a payment method.</div>
            </div>
            <button type="submit" id="submit-button" aria-label="Submit Order">Submit Order</button>
        </form>

        <div class="modal" id="confirmation-modal" role="dialog" aria-labelledby="modal-title" tabindex="-1">
            <div class="modal-content">
                <h3 id="modal-title">Order Confirmation</h3>
                <p>Your order has been successfully submitted!</p>
                <p id="modal-details" aria-live="polite"></p>
                <button type="button" onclick="closeModal()" aria-label="Close Confirmation">Close</button>
            </div>
        </div>
    </div>

    <?php
        include('../public/footer.php');
    ?>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            {
                "@type": "Product",
                "@id": "product1",
                "name": "Wireless Headphones",
                "image": "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60",
                "description": "Immerse yourself in crystal-clear sound with our wireless headphones.",
                "offers": {
                    "@type": "Offer",
                    "price": "10.00",
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock"
                }
            },
            {
                "@type": "Product",
                "@id": "product2",
                "name": "Running Shoes",
                "image": "https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60",
                "description": "Lightweight and durable shoes for your daily runs.",
                "offers": {
                    "@type": "Offer",
                    "price": "20.00",
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock"
                }
            },
            {
                "@type": "Product",
                "@id": "product3",
                "name": "Smart Watch",
                "image": "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60",
                "description": "Track your fitness and stay connected with our smart watch.",
                "offers": {
                    "@type": "Offer",
                    "price": "30.00",
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock"
                }
            }
        ]
    }
    </script>

   
    
        
    </body>
</html>
<?php } else {
    header('location:login.php');
} ?>


