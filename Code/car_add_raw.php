<!DOCTYPE html>
<html lang="zh-TW">
<?php session_start();
include("connect.inc.php");
if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #D3D3D3;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .note {
            font-size: 12px;
            color: #666;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>新增車輛</h2>
        <form name="form" method="post" action="car_add_finish.php">            
            <label for="id">VehicleID:</label>
            <input type="text" name="v" id="v" required>
            <label for="id">Model:</label>
            <input type="text" name="m" id="m" required>
            <label for="id">License Plate:</label>
            <input type="text" name="lp" id="lp" required>
            <label for="ln">Location Name:</label>
            <select name="ln" id="ln" required>
                <option value="">請選擇地點</option>
				<?php
				$sql = "SELECT LocationName FROM Location where used = '站點使用中'";
				$result = mysqli_query($conn, $sql);

				// 檢查查詢結果
				if ($result && mysqli_num_rows($result) > 0) {
					$locations = mysqli_fetch_all($result, MYSQLI_ASSOC); // 獲取所有查詢結果作為關聯陣列
				} else {
					$locations = []; // 如果沒有結果，初始化為空陣列
				}
                foreach ($locations as $location): ?>
                    <option value="<?php echo htmlspecialchars($location['LocationName']); ?>">
                        <?php echo htmlspecialchars($location['LocationName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="id">Rental Rate:</label>
            <input type="text" name="rr" id="rr" required>
            <a href="car_add_finish.php">
            <input type="submit" name="button" value="新增">
            </a>
            <a href="car.php">
            <input type="button" name="button" value="取消">
            </a>
        </form>
    </div>
</body>
</html>
