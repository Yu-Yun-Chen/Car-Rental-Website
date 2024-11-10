<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$managerID = $_SESSION['ManagerID'];

$sql = "SELECT r.ReviewID, r.Rating, r.Comment, r.ReviewDate, r.Processed, v.Model as VehicleModel
        FROM Review r
        JOIN User u ON r.UserID = u.UserID
        JOIN Vehicle v ON r.VehicleID = v.VehicleID
        ORDER BY r.ReviewDate DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>回饋總覽表</title>
    <style>
        html {
            font-size: 20px; /* 調整根元素的字體大小 */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('Rainy.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 65px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.88);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: rgb(0, 87, 112);
            font-size: 1.8rem; /* 調整字體大小 */
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 5px 5px;
            overflow: hidden;
        }
        .content-table thead tr {
            background-color: rgb(200, 217, 222);
            color: rgb(0, 87, 112);
            text-align: left;
            font-weight: bold;
        }
        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }
        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        .content-table tbody tr:nth-of-type(even) {
            background-color: rgba(255, 255, 255, 0.88);
        }
        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid rgba(255, 255, 255, 0.88);
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            text-decoration: none;
            color: rgb(0, 87, 112);
            background-color: rgb(200, 217, 222);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem; /* 使用 rem 單位 */
        }
        .button:hover {
            background-color: rgba(215, 227, 232, 0.9);
        }
        .status {
            display: inline-block;
            padding-left: 10px;
            vertical-align: middle;
        }
        form {
            display: inline;
        }
		.processed {
			color: rgb(10, 160, 10);
			font-size: 16px;
			margin-top: -5px;
		}

		.not-processed {
			color: rgb(230, 8, 8);
			font-size: 16px;
			margin-top: -5px;
		}
    </style>
</head>
<body>
    <div class="container">
        <h2>回饋總覽表</h2>
        <table class="content-table">
            <thead>
                <tr>
                    <th>Review ID</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Review Date</th>
                    <th>Processed</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ReviewID']); ?></td>
                        <td><?php echo htmlspecialchars($row['Rating']); ?></td>
                        <td><?php echo htmlspecialchars($row['Comment']); ?></td>
                        <td><?php echo htmlspecialchars($row['ReviewDate']); ?></td>
                        <td>
                            <form action="processed.php" method="get">
                                <input type="hidden" name="ReviewID" value="<?php echo htmlspecialchars($row['ReviewID']); ?>">
                                <button type="submit" class="button">詳情</button>
                            </form>
                            <span class="status <?php echo $row['Processed'] == 1 ? 'processed' : 'not-processed'; ?>">
                                <?php echo $row['Processed'] == 1 ? '已處理' : '未處理'; ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="buttons">
            <a href="homepage_m.php" class="button">返回首頁</a>
            <a href="rating.php" class="button">統計結果</a>
        </div>
    </div>
</body>
</html>
