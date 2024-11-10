<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$sql = "
    SELECT 
        b.BookingID, 
        b.UserID, 
        b.vehicleID, 
        b.StartDate, 
        b.EndDate, 
        pl.LocationName AS PickupLocationName, 
        rl.LocationName AS ReturnLocationName, 
        b.PaymentMethod, 
        b.PaymentStatus, 
        b.BookingStatus, 
        b.TotalCost 
    FROM 
        booking b
    JOIN 
        Location pl ON b.PickupLocationID = pl.LocationID
    JOIN 
        Location rl ON b.ReturnLocationID = rl.LocationID
";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>所有訂單紀錄</title>
    <style>
        html {
            font-size: 19px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('nviena.jpg') no-repeat center center fixed;
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
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 5px 5px;
            overflow: hidden;
            text-align: left;
        }
        thead tr {
            background-color: rgb(200, 217, 222);
            color: rgb(0, 87, 112);
            font-weight: bold;
			font-size: 18px;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
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
        .edit-button {
            background-color: rgb(200, 217, 222);
        }
        .delete-button {
            background-color: rgba(220,140,145, 0.8);
            color: rgb(0,0,0);
        }
        .edit-button:hover {
            background-color: rgba(215, 227, 232, 0.9);
        }
        .delete-button:hover {
            background-color: rgba(250,170,175, 0.8);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>所有訂單紀錄</h2>
        <table>
            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>會員號碼</th>
                    <th>車輛ID</th>
                    <th>取車日</th>
                    <th>取車地點</th>
                    <th>還車地點</th>
                    <th>還車日</th>
                    <th>付款方式</th>
                    <th>付款狀態</th>
                    <th>總金額</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['BookingID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['UserID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vehicleID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['StartDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PickupLocationName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ReturnLocationName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['EndDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PaymentMethod']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PaymentStatus']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['TotalCost']) . "</td>";
                        echo "<td><a href='booking_edit_m.php?BookingID=" . htmlspecialchars($row['BookingID']) . "' class='button edit-button'>編輯</a>";
                        echo "<a href='booking_delete_m.php?BookingID=" . htmlspecialchars($row['BookingID']) . "' class='button delete-button'>刪除</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>找不到訂單紀錄</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="homepage_m.php" class="button">回首頁</a>
        </div>
    </div>
</body>
</html>
