<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁 | Ride Now</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .bg {
            background-image: url('homepage.png');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            position: absolute;
            top: 10%; /* 调整此值以垂直移动容器 */
            left: 10%; /* 调整此值以水平移动容器 */
        }
        .buttons {
            display: flex;
            gap: 50px;
            margin-top: 20px;
        }
        .buttons a {
            text-decoration: none;
            background-color: rgba(100, 150, 110, 0.9);
            color: white;
            padding: 60px;
            border-radius: 10px;
            font-size: 30px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px; /* 使按钮为正方形 */
            height: 90px; /* 使按钮为正方形 */
        }
        .buttons a:hover {
            background-color: rgba(120, 170, 130, 0.9);
        }
        .button-container {
            position: absolute;
            right: 18%; /* 调整此值以水平移动按钮 */
            top: 68%; /* 调整此值以垂直移动按钮 */
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <div class="bg">
       
        <div class="button-container">
            <div class="buttons">
                <a href="login_u.php">使用者</a>
                <a href="login_m.php">管理者</a>
            </div>
        </div>
    </div>
</body>
</html>
