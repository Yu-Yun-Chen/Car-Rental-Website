<?php
session_start();
include("connect.inc.php"); // Include your database connection script

// Retrieve form data using $_POST
$id = mysqli_real_escape_string($conn, $_POST['id']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password2 = mysqli_real_escape_string($conn, $_POST['password2']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$location = mysqli_real_escape_string($conn, $_POST['location']);

// Validate form data
if ($id && $password && $password2 && $name && $phone && $email && $location) {
    // 檢查 ManagerID 是否等於特定的值
	if ($id != '110704046' && $id != '110704049' && $id != '110704055' && $id != '110704061' && $id != '110704113') {
		echo '您並非管理者';
		header("refresh:2; url=register_m.php"); // Redirect after 2 seconds
		exit();
	}
	
	// Check if passwords match
    if ($password !== $password2) {
        echo 'Passwords do not match.';
        header("refresh:2; url=register_m.php"); // Redirect after 2 seconds
		exit();
    }

    // Check if ManagerID is unique
    $sql_check_id = "SELECT * FROM manager WHERE ManagerID = '$id'";
    $result_check_id = mysqli_query($conn, $sql_check_id);
    if (mysqli_num_rows($result_check_id) > 0) {
        echo 'ManagerID 輸入錯誤';
        header("refresh:2; url=register_m.php"); // Redirect after 2 seconds
		exit();
    }
	
    // Insert data into the database
    $sql_insert = "INSERT INTO manager (ManagerID, Password, Name, Email, Phone, LocationName) 
                   VALUES ('$id', '$password', '$name', '$email', '$phone', '$location')";

    if (mysqli_query($conn, $sql_insert)) {
        echo '註冊成功';
        header("refresh:2; url=login_m.php"); // Redirect after 2 seconds
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    echo 'Please fill out all required fields.';
}
?>
