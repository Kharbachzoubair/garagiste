<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to AutoCrafters</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f2f2f2;
        }

        .container {
            width: 90%;
            max-width: 500px;
            padding: 40px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .garage-img {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
            margin-bottom: 30px;
            animation: pulse 2s infinite alternate;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.05);
            }
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin: 0 10px;
            outline: none;
            background-color: #ff5e3a;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background-color: #484848;
        }

        .btn:hover {
            background-color: #ff3c15;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to AutoCrafters</h1>
        <img src="https://i.pinimg.com/originals/d6/d5/56/d6d556e8d9a1c571e372585c9f72b0e3.jpg" alt="Garage" class="garage-img">
        <div class="btn-container">
            <a href="{{ url('/register') }}" class="btn">Register</a>
            <a href="{{ url('/login') }}" class="btn btn-secondary">Login</a>
        </div>
    </div>
</body>
</html>
