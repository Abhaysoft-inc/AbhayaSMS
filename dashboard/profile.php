<?php

include_once("config.php");

// Getting id from url
$id = $_GET['id'];

// Fetching data from table 
//$sql = "SELECT * FROM students JOIN class ON students.class = class.class_name WHERE id='$id' "; 

// Fetching data from table
$sql = "SELECT students.id, students.name, students.class, students.father, students.dob, students.phone, students.address, students.aadhar, class.monthly_fee, class.class_name FROM students JOIN class ON students.class = class.class_name WHERE students.id='$id'";


$result = mysqli_query($conn, $sql);

// Fetching month names
$sql2 = "SELECT month_name FROM months";
$monthresult = mysqli_query($conn, $sql2);

// Fetching fee details for the student
$sql3 = "SELECT * FROM fee WHERE student_id='$id'";
$feeresult = mysqli_query($conn, $sql3);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <!-- Bootstrap CSS -->
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
  <?php include("nav.php") ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-4">
        <img src="https://via.placeholder.com/150" class="img-fluid rounded-circle" alt="Profile Picture">
        

        <h3></h3>
        <?php
        while($row = mysqli_fetch_assoc($result)){
          echo "<h3>ID: ".$row['id']."</h3><h3>Name: ".$row['name']."</h3><h3>Class: ".$row['class_name']."</h3><br><h3>Personal Details:</h3><p><strong>Father's Name: </strong>".$row['father']."</p><p><strong>Date Of Birth: </strong>".$row['dob']."</p><p><strong>Phone: </strong>".$row['phone']."</p><p><strong>Address: </strong>".$row['address']."</p><p><strong>Aadhar No.: </strong>".$row['aadhar']."</p>";
        };
        ?>
        
      </div>
      <div class="col-md-8">
        <h1>Fee Details <a href="/payment.php?id=<?php echo $id ?>" class="btn btn-primary">Pay Fee</a></h1>
        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th>Select</th>
              <th>Month</th>
              <th>Fee Status</th>
              <th>Amount</th>
              <th>Paid On</th>
              <th>Download Invoice</th>
              <th>Pay</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              // Fetch fee details from the database
              $sql3 = "SELECT f.month, f.status, f.date_paid, c.monthly_fee FROM fee f JOIN students s ON s.id = f.student_id JOIN class c ON c.class_name = s.class WHERE student_id='$id'";
              $feeResult = mysqli_query($conn, $sql3);

              while($feeRow = mysqli_fetch_assoc($feeResult)) {
  echo "<tr>";
  echo "<td>";
      if ($feeRow['status'] == "Unpaid") {
        echo "<input type='checkbox' name='month[]' value='".$feeRow['month']."'>";
      }
  echo "</td>";
  echo "<td>".$feeRow['month']."</td>";
  echo "<td>".$feeRow['status']."</td>";
  echo "<td>".$feeRow['monthly_fee']."</td>";
  echo "<td>".$feeRow['date_paid']."</td>";
  echo "<td>";
  if ($feeRow['status'] == "Paid") {
  echo "<a href='invoice.php?month=".$feeRow['month']."&id=".$id."' class='btn btn-primary'>Download</a></td>";
  }else{
    echo "<a class='d-none'>Download</a></td>";

  }
  echo "<td>";
  if ($feeRow['status'] == "Paid") {
  echo "<button class='d-none'>Pay</button>";
} else {
  echo "<a class='btn btn-success' href='pay.php?id=".$id."&month=".$feeRow['month']."'>Pay</a>";
}
echo "</td>";

  echo "</tr>";
};
?>