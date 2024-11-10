<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>財務管理</title>
    <style>
        html {
            font-size: 20px; /* 調整根元素的字體大小 */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('fcar3.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container { 
            width: 80%;
            margin: 65px auto;
            padding: 20px;
            background-color: rgba(255,255,255,0.88);
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
            background-color: rgba(255,255,255,0.88););
        }
        .content-table tbody tr:last-of-type {
            border-bottom: 2px rgba(255,255,255,0.88);
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
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>財務管理</h2>
        <table class="content-table">
            <thead>
                <tr>
                    <th>VehicleID</th>
                    <th>Model</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $s = @mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(vehicleid) FROM (SELECT vehicleid, SUM(totalcost) FROM booking GROUP BY vehicleid) AS e;"))[0];
                for ($x = 1; $x <= $s; $x++) {
                    $sql = "SELECT * FROM (SELECT vehicleid, SUM(totalcost), ROW_NUMBER() OVER (ORDER BY -SUM(totalcost)) AS num FROM booking GROUP BY vehicleid) T WHERE T.num = $x";
                    $result = mysqli_query($conn, $sql);
                    $row = @mysqli_fetch_row($result);
                    $sql2 = "SELECT Model FROM vehicle WHERE vehicleID = '$row[0]'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = @mysqli_fetch_row($result2);
                    echo "<tr>";
                    echo "<td>{$row[0]}</td>";
                    echo "<td>{$row2[0]}</td>";
                    echo "<td>{$row[1]}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="buttons">
            <a href="homepage_m.php" class="button">回首頁</a>
        </div>
    </div>
</body>
</html>
