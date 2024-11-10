<?php session_start();
include("connect.inc.php");
if (!isset($_SESSION['UserID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>站點地圖 | Ride Now</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            background-image: url('map.jpg');
            background-size: cover;
            background-position: 50% 25%;
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
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background-color: rgba(210, 220, 215, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 16px; /* 调整字体大小 */
            color: rgb(20,30,20); /* 调整字体颜色 */
        }
		.button-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center; /* 水平居中 */
            align-items: center; /* 垂直居中 */
        }
        .button-container button {
            padding: 15px 25px;
            font-size: 18px;
            background-color: rgba(214,226,211,0.95);
            color: rgb(0,10,0);
			font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button-container button:hover {
            background-color: rgba(174,185,171,0.99);
			color: rgba(5, 10, 5);
        }
		
        h2 {
            text-align: center;
            margin-bottom: 5px;
            color: rgb(30,40,30);
			font-size: 27px;
			font-weight: bold;
        }
        form {
            margin-top: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
		input[type="button"] {
			width: 100%;
			background-color: rgba(50,100,70,0.85);
			color: white;
			padding: 13px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 18px;
			margin-top: 10px; /* 设置间距 */
		}
        input[type="submit"] {
            width: 100%;
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
		input[type="button"]:hover {
			background-color: rgba(80,130,100,0.9);
		}
		.title {
            color: #ECF4EB;
            font-weight: bold;
            font-size: 40px;
            margin-left: -650px;
        }
        .note {
            font-size: 12px;
            color: #666;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        input[type="select"]:hover {
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
		.container p {
			font-size: 19px; /* 调整字体大小 */
			/*font-weight: bold;*/
			color: rgb(40,40,40); /* 调整字体颜色 */
			margin-bottom: 20px; /* 调整间距 */
			margin-left: 30px;
		}

		.no-car {
			font-size: 30px; /* 调整字体大小 */
			font-weight: bold;
			
			color: rgb(30,20,20); /* 调整字体颜色 */
			align-items: center;
			margin-bottom: 30px; /* 调整间距 */
            padding: 10px;
		}
		.map-container {
			display: flex;
			justify-content: center;
			align-items: center;
			padding: 20px;
			width: 100vw; /* 使地图容器充满可用宽度 */
			height: calc(100vh - 200px); /* 调整高度，减去其他元素的高度 */
			box-sizing: border-box;
		}
		.map-container iframe {
			width: 100%; /* 使 iframe 充满容器宽度 */
			height: 100%; /* 使 iframe 充满容器高度 */
			border: 0;
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
		<span class="title">站點地圖</span>
        <nav class="nav-links">
            <a href="book.php">立即預約</a>
			<a href="cartype.php">車型一覽表</a>
            <a href="information.php">會員資料</a>
            <a href="homepage_u.php">回主頁</a>
        </nav>
    </div>
    <div class="button-container">
        <?php
				$sql = "SELECT LocationName, LocationID FROM Location where used = '站點使用中'";
				$result = mysqli_query($conn, $sql);

				// 檢查查詢結果
				if ($result && mysqli_num_rows($result) > 0) {
					$locations = mysqli_fetch_all($result, MYSQLI_ASSOC); // 獲取所有查詢結果作為關聯陣列
				} else {
					$locations = []; // 如果沒有結果，初始化為空陣列
				}
                foreach ($locations as $location): ?>
                    <button value="<?php echo htmlspecialchars($location['LocationName']); ?>" onclick="change_map(<?php echo htmlspecialchars($location['LocationID']) ?>)">
                        <?php echo htmlspecialchars($location['LocationName']);?>
                       
                    </button>
                <?php endforeach; ?>
	</div>
    <script>
        function change_map(v) {
            if (v == 1)
                document.getElementById("m").innerHTML = "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d231263.27350810583!2d121.39668846075247!3d25.085315080163937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442ac6b61dbbd8b%3A0xbcd1baad5c06a482!2z5Y-w5YyX5biC!5e0!3m2!1szh-TW!2stw!4v1718791864379!5m2!1szh-TW!2stw\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>";
            else if (v == 2)
                document.getElementById("m").innerHTML = "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d463395.2259849849!2d120.90252345217868!3d24.854448647112513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34683d0eceda863f%3A0x54e44f52583a486a!2z5qGD5ZyS5biC!5e0!3m2!1szh-TW!2stw!4v1718791935158!5m2!1szh-TW!2stw\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>";
            else if (v == 3)
                document.getElementById("m").innerHTML = "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57957.596556630386!2d120.9254838082769!3d24.783473412494892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346835db1a4b4b11%3A0xd409dcbcb5d33b0c!2z5paw56u55biC5paw56u5!5e0!3m2!1szh-TW!2stw!4v1718792012663!5m2!1szh-TW!2stw\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>";
            else if (v == 4)
                document.getElementById("m").innerHTML = "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465744.59078557807!2d120.62621224637509!3d24.219748278296617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346917dff97922ef%3A0x87523ee47ea6447f!2z5Y-w5Lit5biC!5e0!3m2!1szh-TW!2stw!4v1718792058114!5m2!1szh-TW!2stw\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>";
            else if (v == 5)
                document.getElementById("m").innerHTML = "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d469573.8295611645!2d120.0123552844547!3d23.15028096537058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346e7ccc953ffe13%3A0xd47f4caaa5dc764e!2z5Y-w5Y2X5biC!5e0!3m2!1szh-TW!2stw!4v1718792099540!5m2!1szh-TW!2stw\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>";
            else if (v == 6)
                document.getElementById("m").innerHTML = "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d469573.8295611645!2d120.0123552844547!3d23.15028096537058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346e43517a7a741b%3A0x4826a24a54732a37!2z6auY6ZuE5biC!5e0!3m2!1szh-TW!2stw!4v1718792143190!5m2!1szh-TW!2stw\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>";
            else
                document.getElementById("m").innerHTML = "ERROR: UNIDENTIFIED SITE";
        }
    </script>
	<div class="map-container">
        <p id="m"></p>
    </div>
     
</body>


