<!DOCTYPE html>
<html lang="zh-TW">
<?php
session_start();
include("connect.inc.php");
if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>車輛管理 | Management</title>
    <style>
        html {
            font-size: 19px; /* 調整根元素的字體大小 */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('sky.jpg') no-repeat center center fixed;
            background-size: cover; 
            background-color: rgb(240,245,245);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 65px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.9);
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
			color: black;
            min-width: 400px;
            border-radius: 5px 5px 5px 5px;
            overflow: hidden;
            opacity: 0.7; /* 调高表格的透明度 */
        }
        .content-table thead tr {
            background-color: rgb(195, 212, 217);
            color: rgb(0, 87, 112);
            text-align: left;
            font-weight: bold;
        }
        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            text-decoration: none;
            color: rgb(0, 87, 102);
            background-color: rgba(200, 217, 222,0.9);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px; /* 使用 rem 單位 */
			font-weight: bold;
        }
        .button:hover {
            background-color: rgba(185, 205, 215,0.8);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>車輛管理</h2>
        <table class="content-table">
            <thead>
                <tr>
                    <th>VehicleID</th>
                    <th>Model</th>
                    <th>License Plate</th>
                    <th>Rental State</th>
                    <th>Location Name</th>
                    <th>Rental Rate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                include("connect.inc.php");
                
                $query = "SELECT * FROM vehicle ORDER BY vehicleID";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $field) {
                        echo "<td>{$field}</td>";
                    }
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <div class="buttons">
            <a href="car_add.php" class="button">新增車輛</a>
            <a href="car_delete.php" class="button">刪除車輛</a>
            <a href="homepage_m.php" class="button">回首頁</a>
        </div>
    </div>
</body>
</html>
