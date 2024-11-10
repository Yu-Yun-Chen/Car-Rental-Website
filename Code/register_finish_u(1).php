<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connect.inc.php");

$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$name = $_POST['name'];
$id_number = $_POST['id_number'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$birthday = $_POST['birthday'];
$license = $_POST['license'];

// Calculate age
$birthDate = new DateTime($birthday);
$today = new DateTime();
$age = $today->diff($birthDate)->y;

if($birthday != null && $license != null && $name != null && $id != null && $pw != null && $pw2 != null && $pw == $pw2 && $email != null && $phone != null && $address != null && $id_number != null)
{
    // 檢查UserID是否唯一
    $sql = "SELECT * FROM user WHERE UserID = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo 'UserID已被使用!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=register_u.php>';
		exit();
    }else {
            // 檢查ID Number格式
        if (!preg_match('/^[A-Z][0-9]{9}$/', $id_number)) {
            echo 'ID Number格式不正確!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=register_u.php>';
			exit();
        } else {
            	// 檢查年齡
			if ($age < 18) {
				echo '您必須年滿18歲才能註冊!';
				echo '<meta http-equiv=REFRESH CONTENT=2;url=register_u.php>';
				exit();
			} else {
					// 新增資料進資料庫語法
				$sql = "INSERT INTO user VALUES ('$id', '$pw', '$name', '$id_number', '$phone', '$email', '$address', '$birthday', '$license')";
				if (mysqli_query($conn, $sql)) {
					echo '註冊成功，請重新登入!';
					echo '<meta http-equiv=REFRESH CONTENT=2;url=login_u.php>';
				} else {
					echo '註冊失敗!';
					echo '<meta http-equiv=REFRESH CONTENT=2;url=register_u.php>';
				}
			}
        }
    }
    
}
else
{
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=register_u.php>';
}
?>
