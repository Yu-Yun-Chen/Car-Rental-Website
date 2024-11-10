<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #D3D3D3;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
        <h2>註冊帳號</h2>
        <form name="form" method="post" action="register_finish.php">            
            <label for="id">UserID:</label>
            <input type="text" name="id" id="id" required>
            <br>
            <label for="pw">Password:</label>
            <input type="password" name="pw" id="pw" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}" title="Password must be at least 6 characters long, containing letters and numbers." required>
            <br>
            <p class="note">請注意：密碼至少需要包含一個英文字母和一個數字，並且長度至少為六個字元。</p>
            <label for="pw2">Enter password again:</label>
            <input type="password" name="pw2" id="pw2" required>
            <br>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="id_number">ID Number:</label>
            <input type="text" name="id_number" id="id_number" pattern="[A-Z][0-9]{9}" title="ID number must be 10 characters long, starting with an uppercase letter." required>
            <p class="note">您可輸入身分證字號/居留證號碼/護照號碼。</p>
            <br>        
			<label for="birthday">Birthday:</label> <br>
            <input type="date" name="birthday" id="birthday" required>
            <br><br>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" pattern="09\d{8}" title="Invalid phone number" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid email." required>
            <br>
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required>
            <br>
			<label for="license">License Upload:</label>
            <input type="file" name="license" id="license" accept="image/*" required>
            <br><br>
			<p class="note">請上傳註冊者本人駕照正本正面。</p>
			<br>
		
            <input type="submit" name="button" value="確任註冊">
        </form>
    </div>
</body>
</html>
