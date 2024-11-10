<?php
session_start();
include("connect.inc.php"); // Include your database connection script
if (!isset($_SESSION['ManagerID'])) {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    exit();
}

// Retrieve form data using $_POST
$li = mysqli_real_escape_string($conn, $_POST['li']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_insert = "DELETE FROM Location WHERE LocationID='$li';";

$lm = @mysqli_fetch_row(mysqli_query($conn, "select locationname from location where locationid = '$li';"))[0];

$s = "DELETE FROM Manager WHERE LocationName='$lm';";


if ($li){
    if (mysqli_query($conn, $sql_insert)) {
        echo '刪除成功';
        mysqli_query($conn, $s);
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