<?php
session_start();
include("connect.inc.php"); // Include your database connection script

// Retrieve form data using $_POST
$bi = mysqli_real_escape_string($conn, $_POST['BookingID']);
$sd = mysqli_real_escape_string($conn, $_POST['StartDate']);
$pli = mysqli_real_escape_string($conn, $_POST['PickupLocationID']);
$rli = mysqli_real_escape_string($conn, $_POST['ReturnLocationID']);
$ed = mysqli_real_escape_string($conn, $_POST['EndDate']);
$pm = mysqli_real_escape_string($conn, $_POST['PaymentMethod']);
$ps = mysqli_real_escape_string($conn, $_POST['PaymentStatus']);
$tc = mysqli_real_escape_string($conn, $_POST['TotalCost']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$s = "select locationid from location where locationname = '$pli'";
$re = mysqli_query($conn, $s);
$r = @mysqli_fetch_row($re);
$s2 = "select locationid from location where locationname = '$rli'";
$re2 = mysqli_query($conn, $s2);
$r2 = @mysqli_fetch_row($re2);

$sql_insert = "update booking set StartDate = '$sd', PickupLocationID = '$r[0]', ReturnLocationID = '$r2[0]', EndDate = '$ed', PaymentMethod = '$pm', PaymentStatus = '$ps', TotalCost = '$tc' where BookingID = '$bi'";

if ($bi && $sd && $pli && $rli && $ed && $pm && $ps && $tc){
    if (mysqli_query($conn, $sql_insert)) {
        echo '編輯成功';
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