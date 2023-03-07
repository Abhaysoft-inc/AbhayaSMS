<?php
include_once("../config.php");

// perform SQL query to fetch data
$sql = "SELECT students.id, students.name, students.class, class.class_name FROM students JOIN class ON students.class = class.class_name";
//$sql2 = "SELECT class_name FROM class";
$result = mysqli_query($conn, $sql);
//$classresult = mysqli_query($conn, $sql2);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student List</title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Student List</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Students List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Add Student</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container mt-3">
    <h1>Filter Students by Class</h1>
    <form>
      <label for="classSelect" class="form-label">Class:</label>
      <select class="form-select" id="classSelect">
        <option selected>All</option>
        <option value="1">Class 1</option>
        <option value="2">Class 2</option>
        <option value="3">Class 3</option>
      </select>
      <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <table class="table table-striped mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Class</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['class_name']."</td><td><a href='../dashboard/profile.php?id=".$row['id']."' class='btn btn-primary'>View</a><a href='../dashboard/delete.php?id=".$row['id']."' class='btn btn-danger mx-1'>Delete</a></td></tr>"; }?>
       
      </tbody>
    </table>
  </div>
</body></html>
