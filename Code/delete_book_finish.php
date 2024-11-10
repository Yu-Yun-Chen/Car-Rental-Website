<?php
session_start();
include("connect.inc.php"); // Include your database connection script

if (!isset($_SESSION['UserID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}
// Retrieve form data using $_POST
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate form data
if (1) {

    $ui = $_SESSION['UserID'];
    $sql = "delete from booking where userID = '$ui' and BookingStatus = '進行中'";
    $v = "select VehicleID from booking where userID = '$ui' and BookingStatus = '進行中'";
    $r = mysqli_query($conn, $v);
    $row = @mysqli_fetch_row($r);
    $sql2 = "update vehicle set AvailabilityStatus = '未被租借' where VehicleID = '$row[0]'";

    if (mysqli_query($conn, $sql)) {
        echo '刪除成功';
        mysqli_query($conn, $sql2);
        header("refresh:2; url=homepage_u.php"); // Redirect after 2 seconds
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    echo 'Please fill out all required fields.';
}
end:
    ;
?>
