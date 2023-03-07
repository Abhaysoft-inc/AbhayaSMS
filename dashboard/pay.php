<?php

include_once("config.php");

// Getting id and month from url
$id = $_GET['id'];
$month = $_GET['month'];

// Fetching data from table 
$sql = "SELECT * FROM students WHERE id='$id'"; 
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Fetching fee details for the student
$sql2 = "SELECT * FROM fee WHERE student_id='$id' AND month='$month'";
$feeresult = mysqli_query($conn, $sql2);
$feeRow = mysqli_fetch_assoc($feeresult);

// Checking if the fee for the month is already paid
if ($feeRow['status'] == "Paid") {
  echo "Fee for this month has already been paid.";
} else {
  // Processing the payment
  // ...
  // Update the fee details in the database
  $sql3 = "UPDATE fee SET status='Paid', date_paid=NOW() WHERE student_id='$id' AND month='$month'";
  mysqli_query($conn, $sql3);
  echo "Payment successful.";
  header("Location: profile.php?id=".$id."");
}

?>
