<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            margin-top:130px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .welcome-note {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .welcome-note:hover {
            transform: translateY(-5px);
        }

        .welcome-note h1 {
            color: #28a745;
            font-size: 36px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .welcome-note p {
            color: #6c757d;
            font-size: 20px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-note">
            <h1>Welcome, Admin!</h1>
            <p>Crafting with resin isn't just about creating beautiful pieces—it's about pouring your passion, shaping your dreams, and letting your creativity flow. Each piece you make is a reflection of your dedication, talent, and unique vision. Embrace the journey, cherish the process, and remember: in every drop of resin, there's endless potential waiting to be transformed into something extraordinary.</p>
        </div>
    </div>
</body>
</html>
