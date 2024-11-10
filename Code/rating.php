<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$sql_avg_rating = "SELECT v.Model AS Model, AVG(r.Rating) AS AvgRating, COUNT(r.ReviewID) AS RentalCount
                   FROM Review r
                   RIGHT JOIN Vehicle v ON r.VehicleID = v.VehicleID
                   GROUP BY v.Model
                   ORDER BY v.vehicleID ";

$result_avg_rating = mysqli_query($conn, $sql_avg_rating);

$statistics = [];

while ($row = mysqli_fetch_assoc($result_avg_rating)) {
    $statistics[] = $row;
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>統計結果</title>
    <style>
        html {
            font-size: 20px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('download24.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 900px;
            margin: 65px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }
        h2 {
            text-align: center;
            color: rgb(0, 87, 112);
            font-size: 1.8rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 1em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            text-align: left;
            table-layout: fixed; /* 新增這行 */
        }
        thead tr {
            background-color: rgb(200, 217, 222);
            color: rgb(0, 87, 112);
            font-weight: bold;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            width: 33%; /* 新增這行，將寬度設置為 33% */
        }
        tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        tbody tr:nth-of-type(even) {
            background-color: rgba(255, 255, 255, 0.88);
        }
        tbody tr:last-of-type {
            border-bottom: 2px solid rgba(255, 255, 255, 0.88);
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: rgb(200, 217, 222);
            color: rgb(0, 87, 112);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: rgba(215, 227, 232, 0.9);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>統計結果</h2>
        <table>
            <thead>
                <tr>
                    <th>車型</th>
                    <th>平均評分</th>
                    <th>租借次數</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statistics as $stat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($stat['Model']); ?></td>
                        <td><?php echo number_format($stat['AvgRating'], 2); ?></td>
                        <td><?php echo htmlspecialchars($stat['RentalCount']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="feedback.php" class="button">回饋總覽</a>
        </div>
    </div>
</body>
</html>
