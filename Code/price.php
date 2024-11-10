<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>價目一覽表 | Ride Now</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ECF4EB;
            
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .header {
            background-color: #004d00;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            height: 60px;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            width: 100%;
            position: fixed;
            top: 0;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            text-decoration: none;
            margin-right: 20px;
            color: #ECF4EB;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #4F8D6D;
        }

        .container {
            width: 80%;
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 80px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color:#0C7640;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="RideNow-removebg.png" alt="Ride Now Logo" style="height: 90px; width: auto; margin:20px ">
        <nav class="nav-links">
			<a href="book.php">立即訂車</a>
            <a href="cartype.php">車型一覽表</a>
            <a href="information.php">會員資料</a>
			<a href="homepage_u.php">回主頁</a>
        </nav>
    </div>

    <div class="container">
        <h2>價目一覽表</h2>
        <table>
            <thead>
                <tr>
                    <th>地點</th>
                    <th>台北</th>
                    <th>桃園</th>
                    <th>新竹</th>
                    <th>台中</th>
                    <th>台南</th>
                    <th>高雄</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>台北</th>
                    <td>$400</td>
                    <td>$500</td>
                    <td>$800</td>
                    <td>$1200</td>
                    <td>$1500</td>
                    <td>$2000</td>
                </tr>
                <tr>
                    <th>桃園</th>
                    <td>$500</td>
                    <td>$400</td>
                    <td>$500</td>
                    <td>$1000</td>
                    <td>$1500</td>
                    <td>$2000</td>
                </tr>
                <tr>
                    <th>新竹</th>
                    <td>$800</td>
                    <td>$500</td>
                    <td>$400</td>
                    <td>$1000</td>
                    <td>$1200</td>
                    <td>$1500</td>
                </tr>
                <tr>
                    <th>台中</th>
                    <td>$1200</td>
                    <td>$1000</td>
                    <td>$1000</td>
                    <td>$400</td>
                    <td>$800</td>
                    <td>$1000</td>
                </tr>
                <tr>
                    <th>台南</th>
                    <td>$1500</td>
                    <td>$1200</td>
                    <td>$1000</td>
                    <td>$500</td>
                    <td>$400</td>
                    <td>$500</td>
                </tr>
                <tr>
                    <th>高雄</th>
                    <td>$2000</td>
                    <td>$1500</td>
                    <td>$1200</td>
                    <td>$800</td>
                    <td>$500</td>
                    <td>$400</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
