<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From Entak Group</title>
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
            color: #666;
            margin-bottom: 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
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
        <h3 style="text-align: center;">New Update Awaits You</h3>
        <p>Hurray!!!!</p>
        <div class="info">
            <p>A new article was added to our newsletter just for you...</p>
            <p>Title:  {{ $content }}</p>
            <a href="https://entakgroup.com/show?newsquery={{ $newsId }} " class="btn btn-success">Read more</a>
        </div>

        <p>If you have any questions, feel free to contact us at <a href="mailto:info@entakgroup.com">info@entakgroup.com</a>.</p>
        <p>Best regards,<br> <a href="http://entakenergy.com.ng"> Entak Energy & LPG Services Ltd.</a> </p>
    </div>
</body>
</html>
