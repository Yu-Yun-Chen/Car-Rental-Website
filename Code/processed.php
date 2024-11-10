<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

// 獲取ReviewID
if (isset($_GET['ReviewID'])) {
    $reviewID = $_GET['ReviewID'];
} else {
    echo '未提供 ReviewID！';
    exit();
}

// 查询评论详情
$sql = "SELECT r.ReviewID, r.UserID, r.VehicleID, r.Rating, r.Comment, r.ReviewDate, r.Processed, u.Name as UserName, u.Email as UserEmail, u.Phone as UserPhone, v.Model as VehicleModel
        FROM Review r
        JOIN User u ON r.UserID = u.UserID
        JOIN Vehicle v ON r.VehicleID = v.VehicleID
        WHERE r.ReviewID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $reviewID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo '未找到該評論！';
    exit();
}

$review = $result->fetch_assoc();

// 處理評論
if (isset($_POST['process'])) {
    $update_sql = "UPDATE Review SET Processed = 1 WHERE ReviewID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("s", $reviewID);
    $update_stmt->execute();

    if ($update_stmt->affected_rows > 0) {
        echo '評論已標記為處理！';
        $review['Processed'] = 1; // 更新處理狀態
    } else {
        echo '評論處理失敗！';
    }
}

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>評論詳情</title>
    <style>
        html {
            font-size: 18px; /* 調整根元素的字體大小 */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('download22.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 35%;
            margin: 65px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: rgb(0, 87, 112);
            font-size: 1.5rem; /* 調整字體大小 */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 0.9em;
            border-radius: 5px 5px 5px 5px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #dddddd;
        }
        th {
            background-color: rgb(200, 217, 222);
            color: rgb(0, 87, 112);
            text-align: left;
            font-weight: bold;
            font-size: 0.8rem; /* 調整字體大小 */
        }
        td {
            background-color: rgba(255, 255, 255, 0.88);
        }
        .button-container {
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
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>評論詳情</h2>
        <table>
            <tr>
                <th>Review ID</th>
                <td><?php echo htmlspecialchars($review['ReviewID']); ?></td>
            </tr>
            <tr>
                <th>User Name</th>
                <td><?php echo htmlspecialchars($review['UserName']); ?></td>
            </tr>
            <tr>
                <th>User Email</th>
                <td><?php echo htmlspecialchars($review['UserEmail']); ?></td>
            </tr>
            <tr>
                <th>User Phone</th>
                <td><?php echo htmlspecialchars($review['UserPhone']); ?></td>
            </tr>
            <tr>
                <th>Vehicle Model</th>
                <td><?php echo htmlspecialchars($review['VehicleModel']); ?></td>
            </tr>
            <tr>
                <th>Rating</th>
                <td><?php echo htmlspecialchars($review['Rating']); ?></td>
            </tr>
            <tr>
                <th>Comment</th>
                <td><?php echo htmlspecialchars($review['Comment']); ?></td>
            </tr>
            <tr>
                <th>Review Date</th>
                <td><?php echo htmlspecialchars($review['ReviewDate']); ?></td>
            </tr>
            <tr>
                <th>Processed</th>
                <td>
                    <?php echo $review['Processed'] == 1 ? '已處理' : '未處理'; ?>
                    <?php if ($review['Processed'] == 0): ?>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="process" value="1">
                            <button type="submit">標記為已處理</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <div class="button-container">
            <a href="feedback.php" class="button">回饋總覽</a>
        </div>
    </div>
</body>
</html>