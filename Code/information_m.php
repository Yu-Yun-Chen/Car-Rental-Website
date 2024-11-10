<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$managerID = $_SESSION['ManagerID'];

$sql = "SELECT * FROM manager WHERE ManagerID = '$managerID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo '找不到管理員資料!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage_m.php>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理員資料</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('download1.jpg') no-repeat center center fixed;
            background-size: cover; 
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 70px auto;
            padding: 20px;
            background-color: rgba(250, 250, 250, 0.85);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 1.1em; /* 放大字體 */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 1.5em; /* 放大標題字體 */
        }
        .info {
            margin-bottom: 15px;
			margin-left: 30px;
            font-size: 1em; /* 放大信息字體 */
        }
        .info label {
            font-weight: bold;
            color: #555;
        }
        .info span {
            margin-left: 10px;
            color: #222;
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
            background-color: rgb(140, 170, 180);
            color: rgb(250, 250, 250);
            border: 0;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em; /* 放大按鈕字體 */
			font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: rgb(170, 200, 210); /* Darker green on hover */
        }
        .button.logout {
            background-color: rgba(200,120,125, 0.85); /* Dark red color */
        }
        .button.logout:hover {
            background-color: rgba(225,150,150, 0.85); /* Darker red on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>管理員資料</h2>
        <div class="info"><label>ManagerID:</label> <span><?php echo htmlspecialchars($row['ManagerID']); ?></span></div>
        <div class="info"><label>Name:</label> <span><?php echo htmlspecialchars($row['Name']); ?></span></div>
        <div class="info"><label>Email:</label> <span><?php echo htmlspecialchars($row['Email']); ?></span></div>
        <div class="info"><label>Phone:</label> <span><?php echo htmlspecialchars($row['Phone']); ?></span></div>
        <div class="info"><label>Location:</label> <span><?php echo htmlspecialchars($row['LocationName']); ?></span></div>

        <div class="button-container">
            <a href="edit_manager_info.php" class="button">修改資料</a>
            <a href="homepage_m.php" class="button">回首頁</a>
            <a href="logout.php" class="button logout">登出</a>
        </div>
    </div>
</body>
</html>
