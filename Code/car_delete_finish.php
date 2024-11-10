<?php
session_start();
include("connect.inc.php");
if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
} // Include your database connection script

// Retrieve form data using $_POST
$v = mysqli_real_escape_string($conn, $_POST['v']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_insert = "DELETE FROM Vehicle WHERE VehicleID='$v';";


if ($v){
    if (mysqli_query($conn, $sql_insert)) {
        echo '刪除成功';
        header("refresh:2; url=car.php"); // Redirect after 2 seconds
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
else{
    echo 'Please fill all required fields.';
}
?>