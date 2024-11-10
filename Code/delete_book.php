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
    <title>User Return Car</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            background-image: url('street_car.jpg');
            background-size: cover;
            background-position: 50% 90%;
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
		.button{
			width: 100%;
            background-color: rgba(50,100,70,0.85);
            color: white;
            padding: 13px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
		}
		.button-container {
			display: flex;
			justify-content: center;
			gap: 10px;
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
        
		input[type="button"] {
			width: 100%;
			align-items: center;
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
			align-items: center;
            background-color: rgba(200,70,90,0.85);
            color: white;
            padding: 13px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: rgba(220,100,120, 0.9);
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
    </style>
</head>
<body>
    <div class="header">
        <img src="RideNow-removebg.png" alt="Ride Now Logo" style="height: 90px; width: auto;">
        <nav class="nav-links">
            <a href="cartype.php">車型一覽表</a>
            <a href="information.php">會員資料</a>
            <a href="homepage_u.php">回主頁</a>
        </nav>
    </div>
    <div class="container">
        <h2>車輛資訊</h2>
        <form name="form" method="post" action="delete_book_finish.php">
            <?php
            include("connect.inc.php");
            $ui = $_SESSION['UserID'];
            $sql = "SELECT * FROM booking where userID = '$ui' and BookingStatus = '進行中'";
            $result = mysqli_query($conn, $sql);
            $row = @mysqli_fetch_row($result);
            $sql2 = "select Model from vehicle where vehicleID = '$row[2]'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = @mysqli_fetch_row($result2);
            if (!$row[0]){
                echo '<p class="no-car">目前無進行中的訂單！</p>';
                header("refresh:4; url=homepage_u.php"); // Redirect after 2 seconds
                exit;
            }
            echo '<p>Start Date:  ' . $row[3] . '</p>';
            echo '<p>End Date:  ' . $row[6] . '</p>';
            echo '<p>Rent Location:  ' . $row[4] . '</p>';
            echo '<p>Return Location:  ' . $row[5] . '</p>';
            echo '<p>Car Type:  ' . $row2[0] . '</p>';
            ?>
            <input type="hidden" name="vehicleID" value="<?php echo htmlspecialchars($row[2]); ?>">
			<input type="submit" name="button" value="刪除訂單"><br>
			<input type="button" name="button" value="取消" onclick="window.location.href='homepage_u.php'">

        </form>
    </div>
</body>


