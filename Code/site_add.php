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
    <title>Manager Registration</title>
    <style>
        html {
            font-size: 20px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('download12.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 500px;
            margin: 65px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.88);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: rgb(0, 87, 112);
            font-size: 1.6rem;
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
        input[type="text"], input[type="password"], input[type="email"], input[type="tel"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="button"] {
            width: 100%;
            background-color: rgb(200, 217, 222);
            color: rgb(0, 87, 112);
            cursor: pointer;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            padding: 10px;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
			background-color:rgba(215, 227, 232, 0.9);
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
        <h2>新增站點</h2>
        <form name="form" method="post" action="site_add_finish.php">            
            <label for="li">LocationID:</label>
            <input type="text" name="li" id="li" required>
            <label for="ln">LocationName:</label>
            <input type="text" name="ln" id="ln" required>
            <label for="a">Address:</label>
            <input type="text" name="a" id="a" required>
            <label for="mi">ManagerID:</label>
            <input type="text" name="mi" id="mi" required>
            <input type="submit" name="button" value="新增">
            <input type="button" name="button" value="取消" onclick="window.location.href='site.php'">
        </form>
    </div>
</body>
</html>
