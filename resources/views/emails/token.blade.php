<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meter Token Purchase Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
            color: #666; /* Base gray color */
            margin-bottom: 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Use a common sans-serif font */
            font-size: 16px; /* Adjust font size as needed */
            line-height: 1.6; /* Adjust line height for better readability */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Add subtle shadow effect */
        }
        .info {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
        }
        .info p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="text-align: center;">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </div>
        <h3 style="text-align: center;">Meter Token Purchase Confirmation</h3>
        <p>Hello {{ $name}} ,</p>
        <div class="info">
            <p><strong>Meter Token:</strong> {{ $token }}</p>
            <p><strong>Price:</strong> {{ $price }}</p>
            <p><strong>Quantity:</strong> {{ $quantity }} </p>
        </div>
        <p>Thank you for your purchase. If you have any questions, feel free to contact us at <a href="mailto:info@entak.com">info@entak.com</a>.</p>
        <p>Best regards,<br> <a href="http://entakenergy.com.ng">Entak Energy LTD.</a> </p>
    </div>
</body>
</html>
