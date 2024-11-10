<?php
session_start();
include("connect.inc.php"); // Include your database connection script

if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

// Retrieve form data using $_POST
$v = mysqli_real_escape_string($conn, $_POST['v']);
$m = mysqli_real_escape_string($conn, $_POST['m']);
$lp = mysqli_real_escape_string($conn, $_POST['lp']);
$rr = mysqli_real_escape_string($conn, $_POST['rr']);
$ln = mysqli_real_escape_string($conn, $_POST['ln']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_insert = "INSERT INTO vehicle (vehicleID, Model, LicensePlate, AvailabilityStatus, LocationName, RentalRate) 
                   VALUES ('$v', '$m', '$lp', '未被租借', '$ln', '$rr')";


if ($v && $m && $lp && $rr && $ln){
    if (mysqli_query($conn, $sql_insert)) {
        echo '新增成功';
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