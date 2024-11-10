<?php
session_start();
include("connect.inc.php");

if (!isset($_SESSION['UserID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$userID = $_SESSION['UserID'];

$sql = "SELECT * FROM user WHERE UserID = '$userID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo '找不到會員資料!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage_u.php>';
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated data from the form
    $name = $_POST['name'] ?? $row['Name'];
    $id_number = $_POST['id_number'] ?? $row['IDNumber'];
    $phone = $_POST['phone'] ?? $row['Phone'];
    $email = $_POST['email'] ?? $row['Email'];
    $address = $_POST['address'] ?? $row['Address'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password == $confirm_password) {
        // Update the database with the new password if provided, otherwise just update the user details
        if (!empty($new_password)) {
            $update_sql = "UPDATE user SET Name = ?, IDNumber = ?, Phone = ?, Email = ?, Address = ?, Password = ? WHERE UserID = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("sssssss", $name, $id_number, $phone, $email, $address, $new_password, $userID);
        } else {
            $update_sql = "UPDATE user SET Name = ?, IDNumber = ?, Phone = ?, Email = ?, Address = ? WHERE UserID = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("ssssss", $name, $id_number, $phone, $email, $address, $userID);
        }

        if ($stmt->execute()) {
            echo '資料已更新成功!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=information.php>';
            exit();
        } else {
            echo '更新資料時發生錯誤!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=edit_user_info.php>';
        }
    } else {
        echo '新密碼和確認密碼不匹配!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=edit_user_info.php>';
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改會員資料</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('ecar1.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0);
            background-color: rgba(255, 255, 255, 0.85);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: rgb(12,100,64);
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        .required::after {
            content: ' *';
            color: red;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: calc(100% - 22px); /* Consider the padding and border width */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            cursor: pointer;
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: rgba(50,100,70,0.85); /* Green color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color:rgba(80,130,100,0.9);
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
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .button {
            width: 100%;
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: rgba(50,100,70,0.85); /* Green color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
            box-sizing: border-box;
        }
        .button:hover {
            background-color: rgba(80,130,100,0.9); /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>修改會員資料</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name" class="required">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($row['Name']); ?>" required>
            <br>
            <label for="id_number" class="required">ID_Number:</label>
            <input type="text" name="id_number" id="id_number" pattern="[A-Z][0-9]{9}" value="<?php echo htmlspecialchars($row['IDNumber']); ?>" required>
            <br>
            <label for="phone" class="required">Phone:</label>
            <input type="text" name="phone" id="phone" pattern="09\d{8}" value="<?php echo htmlspecialchars($row['Phone']); ?>" required>
            <br>
            <label for="email" class="required">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
            <br>
            <label for="address" class="required">Address:</label>
            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($row['Address']); ?>" required>
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
            <a href="information.php" class="button">返回</a>
        </div>
    </div>
</body>
</html>

