<?php

include_once("../config.php");


// query to fetch options from the students table
$sql = "SELECT DISTINCT class_name FROM class ORDER BY class_name ASC";
$result = mysqli_query($conn, $sql);

// create an array of options from the query results
$options = array();
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = $row['class_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add New Student</title>

  <!-- Bootstrap CSS -->
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<button class="btn btn-secondary mx-5 my-5"><i class="bi bi-arrow-left"></i> Back</button>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="text-center mb-4">Add New Student</h1>
        <form method="post" action="">
          <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
          </div>
          <div class="mb-3">
            <label for="fatherName" class="form-label">Father's Name</label>
            <input type="text" class="form-control" id="fatherName" name="fatherName" required>
          </div>
          <!-- display the dropdown list with options -->
<div class="mb-3">
  <label for="class" class="form-label">Class</label>
  <select class="form-control" id="class" name="class" required>
    <?php foreach ($options as $option) : ?>
      <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
    <?php endforeach; ?>
  </select>
</div>
          <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
          </div>
          <div class="mb-3">
            <label for="profilePic" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profilePic" name="profilePic" accept="image/*" >
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
          </div>
          <div class="mb-3">
            <label for="aadharNo" class="form-label">Aadhar No.</label>
            <input type="text" class="form-control" id="aadharNo" name="aadharNo" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            <a href="../dashboard/" class="btn btn-danger btn-lg">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>


</body>
</html>
 
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get form data
  $name = mysqli_real_escape_string($conn, $_POST['fullName']);
  $fathername = mysqli_real_escape_string($conn, $_POST['fatherName']);
  $class = mysqli_real_escape_string($conn, $_POST['class']);
  $dob = mysqli_real_escape_string($conn, $_POST['dob']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $aadhar = mysqli_real_escape_string($conn, $_POST['aadharNo']);

  // insert data into students table
  //$sql = "INSERT INTO students (name, class, grade) VALUES ('$name', '$class', '$grade')";
  
  
  $sql2 ="INSERT INTO `students` (`id`, `name`, `father`, `class`, `dob`, `phone`, `address`, `aadhar`, `total_fee`, `remaining`, `paid`) VALUES (NULL,'$name' , '$fathername', '$class', '$dob', '$phone', '$address', '$aadhar', '', '', ''); " ;
  
  if (mysqli_query($conn,$sql2) ==1) {
    $student_id = mysqli_insert_id($conn);
    $fee_sql = "INSERT INTO `fee` (`student_id`, `month`, `status`) VALUES ('$student_id', 'January', 'Unpaid'), ('$student_id', 'February', 'Unpaid'), ('$student_id', 'March', 'Unpaid'), ('$student_id', 'April', 'Unpaid'), ('$student_id', 'May', 'Unpaid'), ('$student_id', 'June', 'Unpaid'), ('$student_id', 'July', 'Unpaid'), ('$student_id', 'August', 'Unpaid'), ('$student_id', 'September', 'Unpaid'), ('$student_id', 'October', 'Unpaid'), ('$student_id', 'November', 'Unpaid'), ('$student_id', 'December', 'Unpaid')";
    echo $student_id;

    mysqli_query($conn,$fee_sql);
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

?>