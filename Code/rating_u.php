<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
include("connect.inc.php");

if (!isset($_SESSION['UserID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

if (!isset($_POST['vehicleID'])) {
    echo '無效的車輛!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$vehicleID = $_POST['vehicleID'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating'])) {
    $userID = $_SESSION['UserID'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $reviewDate = date('Y-m-d');

    $sql = "SELECT reviewid FROM review order by reviewid desc";
                $result = mysqli_query($conn, $sql);
                $row = @mysqli_fetch_row($result);
                if ($row[0][3] == '9'){
                    if ($row[0][2] == '9'){
                        $row[0][1] = $row[0][1] + 1;
                        $row[0][2] = 0;
                        $row[0][3] = 0;
                    }
                    else{
                        $row[0][2] = $row[0][2] + 1;
                        $row[0][3] = 0;
                    }
                }  
                else{
                    $row[0][3] = $row[0][3] + 1;
                }
    $ri = $row[0];
    $sql = "INSERT INTO Review (ReviewID, UserID, vehicleID, Rating, Comment, ReviewDate) VALUES ('$ri', ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $userID, $vehicleID, $rating, $comment, $reviewDate);

    if ($stmt->execute()) {
        header("Location: return_finish.php?vehicleID=" . htmlspecialchars($vehicleID));
        exit();
    } else {
        echo '提交評價時發生錯誤!還車失敗';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=rating_u.php?vehicleID=' . htmlspecialchars($vehicleID) . '>';
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>評分</title>
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
            font-size: 16px;
            color: rgb(20,30,20);
        }
        .button {
            width: 100%;
            background-color: rgba(50,100,70,0.85);
            color: white;
            padding: 13px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
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
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        input[type="submit"],
        input[type="button"] {
            background-color: rgba(50,100,70,0.85);
            color: white;
            padding: 13px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            min-width: 100px;
        }
        input[type="submit"]:hover,
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
            font-size: 19px;
            color: rgb(40,40,40);
            margin-bottom: 20px;
            margin-left: 30px;
        }
        .no-car {
            font-size: 30px;
            font-weight: bold;
            color: rgb(30,20,20);
            align-items: center;
            margin-bottom: 30px;
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
        <h2>評分</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="vehicleID" value="<?php echo htmlspecialchars($vehicleID); ?>">
            <label for="rating">評分 (1-5):</label>
            <select name="rating" id="rating" required>
                <option value="">選擇評分</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <br>
            <label for="comment">評論:</label>
            <textarea name="comment" id="comment" rows="4" required></textarea>
            <br>
            <div class="button-container">
                <a href="homepage_u.php"><input type="button" value="取消"></a>
                <input type="submit" value="提交並確認還車">
            </div>
        </form>
    </div>
</body>
</html>


