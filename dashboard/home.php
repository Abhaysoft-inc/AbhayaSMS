<?php

include('config.php');
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
  // User is not logged in, redirect to the login page
  header("Location: ../");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .square {
      width: 200px;
      height: 200px;
      border: 1px solid #ccc;
      text-align: center;
      padding-top: 80px;
    }
    .square:hover {
      background-color: #f5f5f5;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">AbhayaSMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/dashboard/students.php">Students List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/dashboard/addstudent.php">Add Student</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="square mx-auto">
            <a href="students.php">
          <h3>Students List</h3></a>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="square mx-auto">
            <a href="addstudent.php">
          <h3>Add Student</h3></a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
