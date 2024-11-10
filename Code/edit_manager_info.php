<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$managerID = $_SESSION['ManagerID'];

$sql = "SELECT * FROM manager WHERE ManagerID = '$managerID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo '找不到管理員資料!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage_m.php>';
    exit();
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated data from the form
    $name = $_POST['name'] ?? $row['Name'];
    $phone = $_POST['phone'] ?? $row['Phone'];
    $email = $_POST['email'] ?? $row['Email'];
    $location = $_POST['location'] ?? $row['LocationName'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password == $confirm_password) {
        // Update the database with the new password if provided, otherwise just update the manager details
        if (!empty($new_password)) {
            $update_sql = "UPDATE manager SET Name = ?, Phone = ?, Email = ?, LocationName = ?, Password = ? WHERE ManagerID = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("ssssss", $name, $phone, $email, $location, $new_password, $managerID);
        } else {
            $update_sql = "UPDATE manager SET Name = ?, Phone = ?, Email = ?, LocationName = ? WHERE ManagerID = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("sssss", $name, $phone, $email, $location, $managerID);
        }

        if ($stmt->execute()) {
            echo '資料已更新成功!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=information_m.php>';
            exit();
        } else {
            echo '更新資料時發生錯誤!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=edit_manager_info.php>';
        }
    } else {
        echo '新密碼和確認密碼不匹配!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=edit_manager_info.php>';
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改管理員資料</title>
    <style>
        html {
            font-size: 20px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('iena.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 65px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.88);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: rgb(0, 87, 112);
            font-size: 1.8rem;
        }
        form {
            width: 100%;
            margin: 25px 0;
            font-size: 1em;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: rgb(0, 87, 112);
        }
        .required::after {
            content: ' *';
            color: red;
        }
        input[type="text"], input[type="email"], input[type="password"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: rgb(200, 217, 222);
            color: rgb(0, 87, 112);
            cursor: pointer;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            padding: 10px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #dddddd;
        }
        .note {
            font-size: 12px;
            color: #666;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button{
			width: 610px;
            display: inline-block;
            background-color: rgb(200, 217, 222);
            color: rgb(0, 87, 112);
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>修改管理員資料</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name" class="required">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($row['Name']); ?>" required>
            <br>
            <label for="phone" class="required">Phone:</label>
            <input type="text" name="phone" id="phone" pattern="09\d{8}" value="<?php echo htmlspecialchars($row['Phone']); ?>" required>
            <br>
            <label for="email" class="required">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
            <br>
            <label for="location" class="required">Location:</label>
            <select name="location" id="location" required>
                <option value="L01" <?php if($row['LocationID'] == 'L01') echo 'selected'; ?>>台北</option>
                <option value="L02" <?php if($row['LocationID'] == 'L02') echo 'selected'; ?>>桃園</option>
                <option value="L03" <?php if($row['LocationID'] == 'L03') echo 'selected'; ?>>新竹</option>
                <option value="L04" <?php if($row['LocationID'] == 'L04') echo 'selected'; ?>>台中</option>
                <option value="L05" <?php if($row['LocationID'] == 'L05') echo 'selected'; ?>>台南</option>
                <option value="L06" <?php if($row['LocationID'] == 'L06') echo 'selected'; ?>>高雄</option>
            </select>
            <br>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password">
            <br>
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password">
            <br>
            <input type="submit" value="更新資料">
        </form>
        <div class="button-container">
            <a href="information_m.php" class="button">返回</a>
        </div>
    </div>
</body>
</html>
