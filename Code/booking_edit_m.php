<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=login_m.php>';
    exit();
}

if (!isset($_GET['BookingID'])) {
    echo '無效的訂單編號!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=all_bookings.php>';
    exit();
}

$bookingID = $_GET['BookingID'];

// Fetch booking details
$sql = "SELECT * FROM booking WHERE BookingID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $bookingID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo '找不到該訂單!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=all_bookings.php>';
    exit();
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated data from the form
    $startDate = $_POST['StartDate'] ?? $row['StartDate'];
    $pickupLocationID = $_POST['PickupLocationID'] ?? $row['PickupLocataionID'];
    $returnLocationID = $_POST['ReturnLocationID'] ?? $row['ReturnLocationID'];
    $endDate = $_POST['EndDate'] ?? $row['EndDate'];
    $paymentID = $_POST['PaymentID'] ?? $row['PaymentID'];
    $payingStatus = $_POST['PayingStatus'] ?? $row['PayingStatus'];
    $paymentDate = $_POST['PaymentDate'] ?? $row['PaymentDate'];
    $totalCost = $_POST['TotalCost'] ?? $row['TotalCost'];

    // Update the database
    $update_sql = "UPDATE booking SET StartDate = ?, PickupLocataionID = ?, ReturnLocationID = ?, EndDate = ?, PaymentID = ?, PayingStatus = ?, PaymentDate = ?, TotalCost = ? WHERE BookingID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssssi", $startDate, $pickupLocationID, $returnLocationID, $endDate, $paymentID, $payingStatus, $paymentDate, $totalCost, $bookingID);

    if ($stmt->execute()) {
        echo '訂單已更新成功!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=all_bookings.php>';
        exit();
    } else {
        echo '更新訂單時發生錯誤!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=edit_booking.php?BookingID=' . htmlspecialchars($bookingID) . '>';
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯訂單</title>
    <style>
        html {
            font-size: 20px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('55.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: rgb(0, 87, 112);
            font-size: 1.8rem;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: rgb(0, 87, 112); /* 標籤字體顏色 */
        }
        .required::after {
            content: ' *';
            color: red;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px; /* 統一字體大小 */
            color: black; /* 表格內需填寫的字體顏色 */
        }
        input[type="text"]#BookingID,
        input[type="text"]#UserID,
        input[type="text"]#VehicleID {
            color: black; /* 訂單編號、會員號碼等資訊的字體顏色 */
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: rgb(200, 217, 222); /* 修改按鈕顏色 */
            color: rgb(0, 87, 112);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #dddddd; /* 修改按鈕懸停顏色 */
            color: rgb(0, 87, 112);
        }
        .button-container {
            text-align: center;
        }
        .button {
            display: inline-block;
            background-color: rgb(200, 217, 222); /* 修改按鈕顏色 */
            color: rgb(0, 87, 112);
            padding: 10px 20px; /* 修改按鈕寬度 */
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            width: calc(100% - 40px); /* 確保按鈕寬度相同 */
            text-align: center;
        }
        .button:hover {
            background-color: #dddddd; /* 修改按鈕懸停顏色 */
        }
    </style>
</head>
<body>
    <?php
    $a = $row['PickupLocationID'];
    $s = "SELECT LOCATIONNAME FROM LOCATION WHERE LOCATIONID='$a'";
    $re = mysqli_query($conn, $s);
    $r = @mysqli_fetch_row($re);
    $a2 = $row['ReturnLocationID'];
    $s2 = "SELECT LOCATIONNAME FROM LOCATION WHERE LOCATIONID='$a2'";
    $re2 = mysqli_query($conn, $s2);
    $r2 = @mysqli_fetch_row($re2);
    ?>
    <div class="container">
        <h2>編輯訂單</h2>
        <form name="form" method="post" action="booking_edit_m_finish.php">
            <label for="BookingID" class="required">訂單編號:</label>
            <input type="text" name="BookingID" id="BookingID" value="<?php echo htmlspecialchars($row['BookingID']); ?>" readonly required>
            <label for="UserID" class="required">會員號碼:</label>
            <input type="text" name="UserID" id="UserID" value="<?php echo htmlspecialchars($row['UserID']); ?>" readonly required>
            <label for="VehicleID" class="required">車輛ID:</label>
            <input type="text" name="VehicleID" id="VehicleID" value="<?php echo htmlspecialchars($row['vehicleID']); ?>" readonly required>
            <label for="StartDate" class="required">取車日:</label>
            <input type="date" name="StartDate" id="StartDate" value="<?php echo htmlspecialchars($row['StartDate']); ?>" required>
            <label for="PickupLocationID" class="required">取車地點:</label>
            <select name="PickupLocationID" id="PickupLocationID" required>
                <option value="<?php echo $r[0]; ?>"><?php echo $r[0]; ?></option>
                <?php
                $sql = "SELECT LocationName FROM Location WHERE used = '站點使用中'";
                $result = mysqli_query($conn, $sql);
                $locations = $result && mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
                foreach ($locations as $location):
                    if ($location['LocationName'] != $r[0]): ?>
                        <option value="<?php echo htmlspecialchars($location['LocationName']); ?>">
                            <?php echo htmlspecialchars($location['LocationName']); ?>
                        </option>
                    <?php endif;
                endforeach; ?>
            </select>
            <label for="ReturnLocationID" class="required">還車地點:</label>
            <select name="ReturnLocationID" id="ReturnLocationID" required>
                <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?></option>
                <?php
                $sql = "SELECT LocationName FROM Location WHERE used = '站點使用中'";
                $result = mysqli_query($conn, $sql);
                $locations = $result && mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
                foreach ($locations as $location):
                    if ($location['LocationName'] != $r2[0]): ?>
                        <option value="<?php echo htmlspecialchars($location['LocationName']); ?>">
                            <?php echo htmlspecialchars($location['LocationName']); ?>
                        </option>
                    <?php endif;
                endforeach; ?>
            </select>
            <label for="EndDate" class="required">還車日:</label>
            <input type="date" name="EndDate" id="EndDate" value="<?php echo htmlspecialchars($row['EndDate']); ?>" required>
            <label for="PaymentMethod" class="required">付款方式:</label>
            <select name="PaymentMethod" id="PaymentMethod" required>
                <option value="<?php echo htmlspecialchars($row['PaymentMethod']); ?>"><?php echo htmlspecialchars($row['PaymentMethod']); ?></option>
                <?php if (htmlspecialchars($row['PaymentMethod']) == "現金"): ?>
                    <option value="行動支付">行動支付</option>
                    <option value="信用卡">信用卡</option>
                <?php elseif (htmlspecialchars($row['PaymentMethod']) == "行動支付"): ?>
                    <option value="現金">現金</option>
                    <option value="信用卡">信用卡</option>
                <?php else: ?>
                    <option value="現金">現金</option>
                    <option value="行動支付">行動支付</option>
                <?php endif; ?>
            </select>
            <label for="PayingStatus" class="required">付款狀態:</label>
            <select name="PaymentStatus" id="PaymentStatus" required>
                <option value="<?php echo htmlspecialchars($row['PaymentStatus']); ?>"><?php echo htmlspecialchars($row['PaymentStatus']); ?></option>
                <?php if (htmlspecialchars($row['PaymentStatus']) == "已付款"): ?>
                    <option value="未付款">未付款</option>
                <?php else: ?>
                    <option value="已付款">已付款</option>
                <?php endif; ?>
            </select>
            <label for="TotalCost" class="required">總金額:</label>
            <input type="number" name="TotalCost" id="TotalCost" value="<?php echo htmlspecialchars($row['TotalCost']); ?>" required>
            <input type="submit" value="更新訂單">
        </form>
        <div class="button-container">
            <a href="booking_m.php" class="button">返回</a>
        </div>
    </div>
</body>
</html>
