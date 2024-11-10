<?php
session_start();
include("connect.inc.php"); // Include your database connection script

// Retrieve form data using $_POST
$sd = mysqli_real_escape_string($conn, $_POST['l_time']);
$ed = mysqli_real_escape_string($conn, $_POST['r_time']);
$pli = mysqli_real_escape_string($conn, $_POST['l_location']);
$rli = mysqli_real_escape_string($conn, $_POST['r_location']);
$ct = mysqli_real_escape_string($conn, $_POST['cartype']);
$pi = mysqli_real_escape_string($conn, $_POST['pm']);
$ps = mysqli_real_escape_string($conn, $_POST['pi']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate form data
if ($sd && $ed && $pli && $rli && $ct && $pi) {
    // Check if passwords match
    // Check if ManagerID is unique
    // Insert data into the database
    $sql = "SELECT bookingid FROM booking order by bookingid desc";
                $result = mysqli_query($conn, $sql);
                $row = @mysqli_fetch_row($result);
                if ($row[0][3] == '9'){
                    if ($row[0][2] == '9'){
                        $row[0][1] = $row[0][1] + 1;
                        $row[0][2] = 0;
                        $row[0][3] = 0;
                    }
                    else{
                        $row[0][2] = $row[0][2] + 1;
                        $row[0][3] = 0;
                    }
                }  
                else{
                    $row[0][3] = $row[0][3] + 1;
                }
    $bi = $row[0];
    $ui = $_SESSION['UserID'];
    $sql = "SELECT * FROM vehicle where Model='$ct' and AvailabilityStatus = '未被租借'";
    $result = mysqli_query($conn, $sql);
    $row = @mysqli_fetch_row($result);
    if ($row[0] == ""){
        echo '已無此車輛！';
        header("refresh:2; url=homepage_u.php"); // Redirect after 2 seconds
        exit;
        goto end;
    }
    else{
        $vi = $row[0];
    }
    if ($pi == '現金')
        $ppi = '未付款';
    else{
		$ppi = '已付款';
		if (!$ps){
			echo '未填寫付款方式！';
			header("refresh:2; url=book.php"); // Redirect after 2 seconds
			exit;
		}
	}

    $s = "select datediff('$ed', '$sd')";
    $res = mysqli_query($conn, $s);
    $r = @mysqli_fetch_row($res);
    $tc = $r[0] + 1;
	
	if ($tc <= 0){
		echo '還車時間過早！';
		header("refresh:2; url=homepage_u.php"); // Redirect after 2 seconds
        exit;
	}

    $s2 = "select RentalRate from vehicle where vehicleID = '$vi'";
    $res2 = mysqli_query($conn, $s2);
    $r2 = @mysqli_fetch_row($res2);
    $rr = $r2[0];
    $tcrr = $tc * $rr;

    $sp = "select LocationID from location where LocationName = '$pli'";
    $resp = mysqli_query($conn, $sp);
    $rp = @mysqli_fetch_row($resp);

    $sre = "select LocationID from location where LocationName = '$rli'";
    $resre = mysqli_query($conn, $sre);
    $rre = @mysqli_fetch_row($resre);

    $sql_insert = "INSERT INTO booking (BookingID, UserID, VehicleID, StartDate, PickupLocationID, ReturnLocationID, EndDate, TotalCost, PaymentMethod, PaymentStatus, BookingStatus) 
                   VALUES ('$bi', '$ui', '$vi', '$sd', '$rp[0]', '$rre[0]', '$ed', '$tcrr', '$pi', '$ppi', '進行中')";
   
    $sql_insert2 = "UPDATE vehicle SET AvailabilityStatus = '借用中' WHERE VehicleID = '$vi'";

    if (mysqli_query($conn, $sql_insert)) {
        echo '租借成功';
        mysqli_query($conn, $sql_insert2);
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
