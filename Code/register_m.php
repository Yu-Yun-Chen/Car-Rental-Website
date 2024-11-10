<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理員註冊</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://watermark.lovepik.com/photo/20211126/large/lovepik-street-scenes-in-japan-picture_501082421.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: rgb(0, 87, 112);
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: rgba(110, 140, 140, 0.9);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: rgb(200, 217, 222);
        }
        .note {
            font-size: 12px;
            color: #666;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>管理員註冊</h2>
        <form name="form" method="post" action="register_finish_m.php">            
            <label for="id">ManagerID:</label>
            <input type="text" name="id" id="id" required>
            <p class="note">請使用員工編號。</p>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}" title="Password must be at least 6 characters long, containing letters and numbers." required>
            <p class="note">請注意：密碼至少需要包含一個英文字母和一個數字，並且長度至少為六個字元。</p>
            
            <label for="password2">Enter password again:</label>
            <input type="password" name="password2" id="password2" required>
            
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            
            <label for="phone">Phone:</label>
            <input type="tel" name="phone" id="phone" pattern="09\d{8}" title="Invalid phone number" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email." required>
            
            <label for="location">Location:</label>
            <select name="location" id="location" required>
                <option value="">請選擇任職據點</option>
                <?php
                // 包含資料庫連接設定
                include("connect.inc.php");

                // 查詢所有的 LocationName
                $sql = "SELECT LocationName FROM Location";
                $result = mysqli_query($conn, $sql);

                // 檢查查詢結果
                if ($result && mysqli_num_rows($result) > 0) {
                    $locations = mysqli_fetch_all($result, MYSQLI_ASSOC); // 獲取所有查詢結果作為關聯陣列
                } else {
                    $locations = []; // 如果沒有結果，初始化為空陣列
                }

                // 釋放結果集
                mysqli_free_result($result);

                // 關閉資料庫連接
                mysqli_close($conn);
                ?>

                <?php foreach ($locations as $location): ?>
                    <option value="<?php echo htmlspecialchars($location['LocationName']); ?>">
                        <?php echo htmlspecialchars($location['LocationName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="button" value="確認註冊">
        </form>
    </div>
</body>
</html>
