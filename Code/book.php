<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>租車預訂 | Ride Now</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            background-image: url('green_car2.jpg');
            background-size: cover;
            background-position: center;
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
            max-width: 700px;
            margin: 50px auto 50px;
            padding: 20px;
            background-color: rgba(206, 214, 205, 0.8); 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: grid;
            gap: 10px;
        }

        label {
            color: rgb(10,25,10);
            font-weight: bold;
            font-size: 18px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="date"],
        input[list],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
			max-width: 300px; /* 设置最大宽度 */
			margin-left: 200px;
            background-color: rgba(50,100,70,0.85);
            color: white;
            padding: 13px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: rgba(80,130,100,0.9);
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
		<span class="title">租車預訂</span>
        <nav class="nav-links">
            <a href="cartype.php">車型一覽表</a>
			<a href="map.php">站點地圖</a>
            <a href="information.php">會員資料</a>
			<a href="homepage_u.php">回主頁</a>

        </nav>
    </div>

    

    <div class="container">
        <?php
            include("connect.inc.php");
            $ui = $_SESSION['UserID'];
            $sql = "SELECT * FROM booking where userID = '$ui' and BookingStatus = '進行中'";
            $result = mysqli_query($conn, $sql);
            $row = @mysqli_fetch_row($result);
            if ($row[0]){
                echo '您尚有車未還，不可借車！';
                header("refresh:4; url=homepage_u.php"); // Redirect after 2 seconds
                exit;
            }
            ?>
        <form name="form" method="post" action="book_finish.php">
            <label for="l_time">借車時間</label>
            <input type="date" name="l_time" id="l_time" required>

            <label for="r_time">還車時間</label>
            <input type="date" name="r_time" id="r_time" required>

            <label for="l_location">借車地點</label>
            <select name="l_location" id="l_location" required>
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

            <label for="r_location">還車地點</label>
            <select name="r_location" id="r_location" required>
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

            <label for="cartype">車款</label>
            <select name="cartype" id="cartype" required>
                <option value="">請選擇車款</option>
				<?php
				$sql = "select model from (select model from vehicle where AvailabilityStatus = '未被租借') as e group by model";
				$result = mysqli_query($conn, $sql);

				// 檢查查詢結果
				if ($result && mysqli_num_rows($result) > 0) {
					$locations = mysqli_fetch_all($result, MYSQLI_ASSOC); // 獲取所有查詢結果作為關聯陣列
				} else {
					$locations = []; // 如果沒有結果，初始化為空陣列
				}
                foreach ($locations as $location): ?>
                    <option value="<?php echo htmlspecialchars($location['model']); ?>">
                        <?php echo htmlspecialchars($location['model']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="pm">付款方式</label>
            <input id="pm" name="pm" list="typelist3" placeholder="請選擇付款方式" required>
            <datalist id="typelist3">
                <option value="現金"></option>
                <option value="行動支付"></option>
                <option value="信用卡"></option>
            </datalist>

            <label for="pi">付款資訊 (現金付款免填)</label>
            <input type="text" name="pi" id="pi">

            <input type="submit" name="button" value="確定">
        </form>
    </div>
</body>

</html>
