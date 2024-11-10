<?php
session_start();
include("connect.inc.php");
if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}
 // Include your database connection script

// Retrieve form data using $_POST
$li = mysqli_real_escape_string($conn, $_POST['li']);
$ln = mysqli_real_escape_string($conn, $_POST['ln']);
$a = mysqli_real_escape_string($conn, $_POST['a']);
$mi = mysqli_real_escape_string($conn, $_POST['mi']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_insert = "INSERT INTO location (LocationID, LocationName, Address, ManagerID, used) 
                   VALUES ('$li', '$ln', '$a', '$mi', '站點使用中')";


if ($li && $ln && $a && $mi){
    if (mysqli_query($conn, $sql_insert)) {
        echo '新增成功';
        header("refresh:2; url=site.php"); // Redirect after 2 seconds
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
else{
    echo 'Please fill all required fields.';
}
?>