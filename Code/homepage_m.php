<?php session_start();
include("connect.inc.php");
if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
} ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者主頁 | Ride Now</title>
    <style>
       

        body {
            font-family: Arial, sans-serif;
            background: url('download.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f0f0f0;
			background-position: 50% 10%;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: rgb(240,245,245); /* Lighter color to highlight the logo ecf4eb #e0f7fa */
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 20px;
            margin-bottom: 0; /* Ensure there's no margin at the bottom */
        }
        .navbar .left-section {
            display: flex;
            align-items: center; /* Center-align items vertically */
        }
        .navbar img {
            height: 100px; /* Increased the size of the logo */
        }
        .navbar .company-name {
            font-size: 38px; /* Font size for company name */
            font-weight: bold; /* Bold font */
            color:rgb(20,110,130); /* Matching color */
            margin-left: 20px; /* Adjust this value to move the company name to the left */
            font-family: 'Merriweather', serif; /* Adjust font family to match image */
        }
        .navbar .right-section {
            display: flex;
            gap: 20px;
			font-size: 30 px; /* Increased font size */
        }
        :root {
		--navbar-font-size: 19px; /* 預設字體大小，可以隨意調整 */
		}

		.navbar a {
		display: block;
		color: rgb(0,87,112); /* Dark greenish-blue text color */
		text-align: center;
		padding: 14px 20px;
		text-decoration: none;
		font-size: var(--navbar-font-size); /* 使用變數 */
		font-weight: bold; /* Made the font bold */
		}
		
        .navbar a:hover {
            background-color: rgb(200,217,222); /* Lighter shade of the navbar color #b2ebf2*/
            color:rgb(0,87,112); /* Dark greenish-blue text color */
            border-radius: 10px;
        }
        .container {
            text-align: center;
            padding: 50px;
        }
        .container h1 {
            font-size: 50 px;
            margin-bottom: 20px;
        }
        .image-container {
            text-align: center;
            margin: 0; /* Remove top and bottom margins */
            padding: 0; /* Remove padding */
        }
        .image-container img {
            width: 100%; /* Ensure image fits the width of the container */
            height: auto; /* Maintain aspect ratio */
            max-height: calc(100vh - 118px); /* Adjust the height to fit the screen, subtracting the navbar height */
            object-fit: cover; /* Ensure the image covers the container */
            object-position: 50% 70%; /* Center of the image */
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="left-section">
            <img src="RideNow-removebg.png" alt="Company Logo">
            <span class="company-name">Ride Now 租車</span>
        </div>
        <div class="right-section">
            <a href="car.php">車款管理</a>
			<a href="site.php">據點管理</a>
            <a href="booking_m.php">訂單管理</a>
            <a href="feedback.php">回饋管理</a>
            <a href="finance.php">財務概要</a>
            <a href="information_m.php">管理者資料</a>
        </div>
    </div>
    <div class="image-container">
        <img src="68.png" alt="Lush Green Mountains and Car">
    </div>
</body>
</html>
