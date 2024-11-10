<!DOCTYPE html>
<html lang="zh-TW">
<?php
session_start();
include("connect.inc.php");
if (!isset($_SESSION['UserID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>車型一覽表 | Ride Now</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ECF4EB;
			background-image: url('street1.jpg');
			background-size: cover;
			background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .header {
            background-color: rgba(80,130,100,0.9);
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
            background-color: rgba(120,170,140,0.7);
        }

        .container {
            width: 80%;
            max-width: 800px;
            background-color: rgba(236,244,235,0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0);
            margin-top: 120px;
        }

        h1 {
            text-align: center;
            margin-bottom: 15px;
			margin-top: 1px;
            color: rgb(50,80,80);
        }

        .product {
            display: flex;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .product img {
            width: 300px;
            height: 150px;
            object-fit: contain;
            margin-right: 40px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-info h2 {
            margin: 0;
            color: #004b45;
        }

        .product-info .price {
            font-size: 1.2em;
            color: #555;
        }

        .star-rating {
            display: flex;
            align-items: center;
        }

        .star-rating span {
            color: gold;
            margin-right: 5px;
        }

        .reviews {
            margin-left: 10px;
            color: #555;
        }

        ul {
            list-style: none;
            padding: 0;
            color: #004b45;
        }

        ul li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="RideNow-removebg.png" alt="Ride Now Logo" style="height: 90px; width: auto; margin:20px ">
        <nav class="nav-links">
            <a href="book.php">立即預約</a>
			<a href="map.php">站點地圖</a>
            <a href="information.php">會員資料</a>
            <a href="homepage_u.php">回主頁</a>
        </nav>
    </div>

    <div class="container">
        <h1>車型一覽表</h1>
        <?php session_start();
        include("connect.inc.php");
        $s = "select count(*) from (SELECT * FROM vehicle group by model) as e";
        $re = mysqli_query($conn, $s);
        $r = @mysqli_fetch_row($re);
        $x = $r[0];
        $mnl = @mysqli_fetch_all(mysqli_query($conn, "SELECT model FROM vehicle group by model"));
        for ($i = 1; $i <= $x; $i++){?>
            <div class="product">
                <img src="<?php echo $mnl[$i - 1][0]; ?>" alt="<?php echo $mnl[$i - 1][0]; ?>">
                <div class="product-info">
                    <h2><?php echo $mnl[$i - 1][0]; ?></h2>
                    <div class="star-rating">
                        <span><?php
                        $temp = $mnl[$i - 1][0];
                        $s = @mysqli_fetch_row(mysqli_query($conn, "select r from (SELECT model, round(avg(rating)) as r FROM review join vehicle where review.vehicleid = vehicle.vehicleid group by vehicle.model) as e where model = '$temp'"));
                        for ($j = 1; $j <= 5; $j++){
                            if ($j <= $s[0])
                                echo '★';
                            else
                                echo '☆';
                        }?></span>
                        <span class="reviews"><?php
                        $temp = $mnl[$i - 1][0];
                        $s = @mysqli_fetch_row(mysqli_query($conn, "select r from (SELECT model, count(rating) as r FROM review join vehicle where review.vehicleid = vehicle.vehicleid group by vehicle.model) as e where model = '$temp'"));
                        if (!$s[0])
                            echo 0;
                        else
                            echo $s[0];?> Reviews</span>
                    </div>
                    <div class="price">$<?php
                        $temp = $mnl[$i - 1][0];
                        $s = @mysqli_fetch_row(mysqli_query($conn, "SELECT rentALrate FROM vehicle where model = '$temp'"));
                        echo $s[0];
                        ?>/day</div>
                    <ul>
                        <?php
                        if ($mnl[$i - 1][0] == "TOYOTA YARIS"){?>
                        <li><?php echo '五人座'; ?></li>
                        <li><?php echo '舒適'; ?></li>
                        <li><?php echo '寬敞'; ?></li>
                        <?php } else if ($mnl[$i - 1][0] == "NISSAN TIIDA"){?>
                        <li><?php echo '五人座'; ?></li>
                        <li><?php echo '馬力強勁'; ?></li>
                        <li><?php echo '價格優惠f'; ?></li>
                        <?php } else if ($mnl[$i - 1][0] == "TOYOTA SIENTA"){?>
                        <li><?php echo '七人座'; ?></li>
                        <li><?php echo '日常代步'; ?></li>
                        <li><?php echo '收納位置多'; ?></li>
                        <?php } else if ($mnl[$i - 1][0] == "TESLA Model_3"){?>
                        <li><?php echo '五人座'; ?></li>
                        <li><?php echo '電動車'; ?></li>
						<li><?php echo '充電迅速'; ?></li>
                        <?php }?> 
                    </ul>
                </div>
            </div><?php
        }
        ?>
</body>
</html>
