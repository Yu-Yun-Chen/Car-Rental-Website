<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carName = $_POST['carName'];
    $carType = $_POST['carType'];
    $carPrice = $_POST['carPrice'];
    $carStatus = $_POST['carStatus'];

    $sql = "INSERT INTO cars (carName, carType, carPrice, carStatus) VALUES ('$carName', '$carType', '$carPrice', '$carStatus')";
    if (mysqli_query($conn, $sql)) {
        echo "新車輛已成功加入";
    } else {
        echo "錯誤: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增車輛</title>
    <style>
        html {
            font-size: 19px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('down.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 65px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.88);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
			margin-left: 20px;
            text-align: center;
            color: rgb(0, 87, 112);
            font-size: 1.8rem;
        }
        form {
            width: 100%;
            margin: 25px 0;
            font-size: 1em;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: rgb(0, 87, 112);
        }
        input[type="text"], input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .button-container {
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            color: rgb(0, 87, 102);
            background-color:rgba(185, 205, 215,0.8);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size:  18px;
            text-decoration: none;
			font-weight: bold;
            transition: background-color 0.3s;
        }
		
        .button:hover {
            background-color: rgba(215, 227, 232, 0.9);
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

            <div class="button-container">
                <button type="submit" class="button">新增</button>
                <a href="car.php" class="button">取消</a>
            </div>
        </form>
    </div>
</body>
</html>
