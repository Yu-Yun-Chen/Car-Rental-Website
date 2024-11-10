<?php
session_start();
include("connect.inc.php"); // Include your database connection script


if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

$bi = mysqli_real_escape_string($conn, $_POST['BookingID']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql_insert = "delete from booking where bookingid='$bi'";

if ($bi){
    if (mysqli_query($conn, $sql_insert)) {
        echo '刪除成功';
        header("refresh:2; url=booking_m.php"); // Redirect after 2 seconds
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
else{
    echo 'Please fill all required fields.';
}
?>