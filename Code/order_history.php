<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['UserID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$userID = $_SESSION['UserID'];

// Fetch order history for the logged-in user with additional details
$sql = "SELECT 
            b.BookingID AS 訂單編號, 
            v.Model AS 車款, 
            b.StartDate AS 取車日, 
            pl.LocationName AS 取車地點, 
            rl.LocationName AS 還車地點, 
            b.EndDate AS 還車日, 
            b.TotalCost AS 總金額, 
            b.PaymentMethod AS 付款方式, 
            b.PaymentStatus AS 付款狀態, 
            b.BookingStatus AS 訂單狀態
        FROM 
            booking b
        JOIN 
            vehicle v ON b.vehicleID = v.vehicleID
        JOIN 
            Location pl ON b.PickupLocationID = pl.LocationID
        JOIN 
            Location rl ON b.ReturnLocationID = rl.LocationID
        WHERE 
            b.UserID = '$userID'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單紀錄</title>
    <style>
        body {
            font-family: Arial, sans-serif;
			background-image: url('street2.jpg');
			background-size: cover;
			background-repeat: no-repeat;
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
            background-color: rgba(240,240,240,0.88);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: rgb(50,80,80);
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
            background-color: rgba(50,100,70,0.85);
            color: white;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: rgba(50,100,70,0.85);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: rgba(80,130,100,0.9);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>訂單紀錄</h2>
        <table>
            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>車款</th>
                    <th>取車地點</th>
                    <th>取車日</th>
                    <th>還車地點</th>
                    <th>還車日</th>
                    <th>總金額</th>
                    <th>付款方式</th>
                    <th>付款狀態</th>
                    <th>訂單狀態</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['訂單編號']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['車款']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['取車地點']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['取車日']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['還車地點']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['還車日']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['總金額']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['付款方式']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['付款狀態']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['訂單狀態']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>找不到訂單紀錄</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="information.php" class="button">回上一頁</a>
        </div>
    </div>
</body>
</html>

