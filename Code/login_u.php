<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('https://c4.wallpaperflare.com/wallpaper/498/852/902/france-british-car-street-wallpaper-preview.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* Add transparency */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: rgb(255, 255, 255); /*White*/
        }
        input[type="submit"] {
            width: 100%;
            background-color: rgba(50, 100, 70, 0.85);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="submit"]:hover {
            background-color: rgba(120, 170, 140, 0.7);
        }
        .register-link a {
            display: block;
            width: 100%;
            background-color: rgba(50, 100, 70, 0.85);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            box-sizing: border-box;
            text-decoration: none;
            margin-top: 5px;
        }
        .register-link a:hover {
            background-color: rgba(120, 170, 140, 0.7);
        }
    </style>
</head>
<body>

<div class="login-container">
    <form name="form" method="post" action="connect_u.php">
        <h2>登入</h2>
        <label for="id">UserID：</label>
        <input type="text" id="id" name="id" required> <br>
        <label for="pw">Password：</label>
        <input type="password" id="pw" name="pw" required> <br>
        <input type="submit" name="button" value="登入">
    </form>

    <div class="register-link">
        <a href="register_u.php">註冊帳號</a>
    </div>
</div>

</body>
</html>


