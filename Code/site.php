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
    <title>站點管理</title>
    <style>
        html {
            font-size: 19px; /* 調整根元素的字體大小 */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('rroad.jpg') no-repeat center center fixed;
            background-size: cover; 
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            padding: 25px;

            background-color: rgba(255, 255, 255, 0.88); /* 增加透明度 */
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
            border-radius: 5px 5px 0 0;
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
 
  
        .buttons {
            text-align: center;
            margin-top: 25px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            color: rgb(0, 87, 102);
            background-color:rgba(185, 205, 215,0.8);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px; /* 使用 rem 單位 */
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: rgba(215, 227, 232, 0.9);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>站點管理</h2>
        <table class="content-table">
            <thead>
                <tr>
                    <th>LocationID</th>
                    <th>LocationName</th>
                    <th>Address</th>
                    <th>ManagerID</th>
                    <th>Used</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT LocationID, LocationName, Address, ManagerID, Used FROM location ORDER BY LocationID";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['LocationID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['LocationName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ManagerID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Used']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="buttons">
            <a href="site_add.php" class="button">新增站點</a>
            <a href="site_delete.php" class="button">刪除站點</a>
            <a href="homepage_m.php" class="button">回首頁</a>
        </div>
    </div>
</body>
</html>
