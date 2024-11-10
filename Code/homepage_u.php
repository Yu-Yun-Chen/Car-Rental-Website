<?php session_start();
    include("connect.inc.php");
    if (!isset($_SESSION['UserID'])) {
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
        exit();
    } ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用者主頁 | Ride Now</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap'); /* Example font, adjust as needed */

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #ECF4EB; /* Lighter color to highlight the logo ecf4eb #e0f7fa */
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
            color:#004b45; /* Matching color */
            margin-left: 20px; /* Adjust this value to move the company name to the left */
            font-family: 'Merriweather', serif; /* Adjust font family to match image */
        }
        .navbar .right-section {
            display: flex;
            gap: 10px;
        }
        .navbar a {
            display: block;
            color: #004d66; /* Dark greenish-blue text color */
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 20px; /* Increased font size */
            font-weight: bold; /* Made the font bold */
        }
        .navbar a:hover {
            background-color: #C2D6BF; /* Lighter shade of the navbar color #b2ebf2*/
            color: #004d66; /* Dark greenish-blue text color */
            border-radius: 10px;
        }
        .container {
            text-align: center;
            padding: 50px;
        }
        .container h1 {
            font-size: 24px;
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
            <a href="book.php">立即預約</a>
            <a href="delete_book.php">刪除訂單</a>
            <a href="return.php">我要還車</a>
			<a href="map.php">站點地圖</a>
            <a href="cartype.php">車型一覽表</a>
            <a href="information.php">會員資料</a>
        </div>
    </div>
    <div class="image-container">
        <img src="pic.webp" alt="Lush Green Mountains and Car">
    </div>
</body>
</html>
