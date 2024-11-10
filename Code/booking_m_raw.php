<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=login_m.php>';
    exit();
}

// Fetch all bookings
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
        .edit-button {
            background-color: #4caf50;
        }
        .edit-button:hover {
            background-color: #45a049;
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
					<th>還車日</th>
					
                    <th>取車地點</th>
                    <th>還車地點</th>
					
                    <th>付款方式</th>
                    <th>付款狀態</th>
                    <th>訂單狀態</th>
					
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
                        echo "<td>" . htmlspecialchars($row['EndDate']) . "</td>";
						
                        echo "<td>" . htmlspecialchars($row['PickupLocationName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ReturnLocationName']) . "</td>";

                        echo "<td>" . htmlspecialchars($row['PaymentMethod']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PaymentStatus']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['BookingStatus']) . "</td>";
						
                        echo "<td>" . htmlspecialchars($row['TotalCost']) . "</td>";
                        echo "<td><a href='booking_edit_m.php?BookingID=" . htmlspecialchars($row['BookingID']) . "' class='button edit-button'>編輯</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>找不到訂單紀錄</td></tr>";
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

