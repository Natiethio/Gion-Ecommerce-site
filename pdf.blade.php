<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1, h2, h3 {
            margin: 0;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        p {
            margin: 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-heading {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .section-content {
            margin-left: 20px;
        }
        
    </style>
</head>
<body>
    <h1>Gion Service Charge</h1>
    <h2>Order Detail</h2>

    <div class="section">
        <p class="section-heading">Customer Details:</p>
        <div class="section-content">
            <p>Customer Name: {{$order->name}}</p>
            <p>Customer Email: {{$order->email}}</p>
            <p>Customer Address: {{$order->address}}</p>
            <p>Customer Phone: {{$order->phone}}</p>
            <!-- <p>Customer Id: {{$order->user_id}}</p> -->
        </div>
    </div>

    <div class="section">
        <p class="section-heading">Product Details:</p>
        <div class="section-content">
            <p>Product Name: {{$order->product_title}}</p>
            <p>Product Price: {{$order->price}}</p>
            <p>Product Quantity: {{$order->quantity}}</p>
            <p>Payment Status: {{$order->payment_status}}</p>
            <p>Order Number: {{$order->order_no}}</p>
        </div>
    </div>

    <h1>Thank You For Shopping With Us!!</h1>
</body>
</html>