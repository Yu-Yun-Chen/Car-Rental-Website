<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['UserID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$userID = $_SESSION['UserID'];

$sql = "SELECT * FROM user WHERE UserID = '$userID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo '找不到會員資料!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage_u.php>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員資料 | Ride Now</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            background-image: url('white_car.jpg');
            background-size: 95%;
            background-position: 50% 60%;
            margin: 0;
            padding: 0;
        }
		.header {
            background-color: rgba(80,130,100,0.9);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            display: flex;
            height: 60px;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

        .nav-links {
            display: flex;
            gap: 3px;
        }

        .nav-links a {
            text-decoration: none;
            margin-right: 10px;
            color: #ECF4EB;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color:rgba(120,170,140,0.7);
        }
        
        .container {
            max-width: 550px;
            margin: 50px auto 50px;
            padding: 20px;
            background-color: rgba(235, 235, 230, 0.80); 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .info {
            margin-bottom: 15px;
        }
        .info label {
            font-size: 18px; /* 调整字体大小 */
			font-weight: bold;
			color: rgb(40,60,60); /* 调整字体颜色 */
			margin-bottom: 20px; /* 调整间距 */
			margin-left: 70px;
        }
        .info span {
            margin-left: 10px;
			font-size: 16px; 
            color:rgb(40,40,40);
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
			
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: rgba(50,100,70,0.85); /* Green color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: rgba(80,130,100,0.9); /* Darker green on hover */
        }
        .button.logout {
            background-color: rgba(170,50,70,0.85); /* Dark red color */
        }
        .button.logout:hover {
            background-color: rgba(210,70,90, 0.9); /* Darker red on hover */
        }
		.title {
            color: #ECF4EB;
            font-weight: bold;
            font-size: 30px;
            margin-left: -500px;
        }

    </style>
</head>
<body>
	<div class="header">
        <img src="RideNow-removebg.png" alt="Ride Now Logo" style="height: 90px; width: auto;">
		<span class="title">會員資料</span>
        <nav class="nav-links">
			<a href = "book.php">立即預約</a>
            <a href="cartype.php">車型一覽表</a>
			<a href = "map.php">站點地圖</a>
			<a href="homepage_u.php">回主頁</a>

        </nav>
    </div>
    <div class="container">
        <div class="info"><label>UserID:</label> <span><?php echo htmlspecialchars($row['UserID']); ?></span></div>
        <div class="info"><label>Name:</label> <span><?php echo htmlspecialchars($row['Name']); ?></span></div>
        <div class="info"><label>ID Number:</label> <span><?php echo htmlspecialchars($row['IDNumber']); ?></span></div>
        <div class="info"><label>Birthday:</label> <span><?php echo htmlspecialchars($row['Birthday']); ?></span></div>
        <div class="info"><label>Phone:</label> <span><?php echo htmlspecialchars($row['Phone']); ?></span></div>
        <div class="info"><label>Email:</label> <span><?php echo htmlspecialchars($row['Email']); ?></span></div>
        <div class="info"><label>Address:</label> <span><?php echo htmlspecialchars($row['Address']); ?></span></div>
                
        <div class="button-container">
            <a href="edit_user_info.php" class="button">修改會員資料</a>
            <a href="order_history.php" class="button">訂單紀錄</a>
            <a href="homepage_u.php" class="button">回主頁</a>
            <a href="logout.php" class="button logout">登出</a>
        </div>
    </div>
</body>
</html>
