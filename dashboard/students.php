<?php
include_once("../config.php");

// perform SQL query to fetch class data
$classSql = "SELECT class_name FROM class";
$classResult = mysqli_query($conn, $classSql);

// set default filter values
$classFilter = 'All';

// check if filter form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classFilter = $_POST['classSelect'];
}

// perform SQL query to fetch student data based on filter
if ($classFilter === 'All') {
    $studentSql = "SELECT students.id, students.name, students.class, class.class_name FROM students JOIN class ON students.class = class.class_name";
} else {
    $studentSql = "SELECT students.id, students.name, students.class, class.class_name FROM students JOIN class ON students.class = class.class_name WHERE class.class_name = '$classFilter'";
}
$studentResult = mysqli_query($conn, $studentSql);
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
                        <a class="nav-link " aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard/students.php">Students List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/addstudent.php">Add Student</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <a href="/" class="btn btn-secondary mx-5 my-5"><i class="bi bi-arrow-left"></i> Back</a>
    <div class="container mt-3">
        <h1>Filter Students by Class</h1>
        <form method="POST">
            <label for="classSelect" class="form-label">Class:</label>
            <select class="form-select" id="classSelect" name="classSelect">
                <option value="All" <?php if ($classFilter === 'All') {
                                        echo ' selected';
                                    } ?>>All</option>
                <?php while ($classRow = mysqli_fetch_assoc($classResult)) {
                    echo "<option value='" . $classRow['class_name'] . "'";
                    if ($classFilter === $classRow['class_name']) {
                        echo ' selected';
                    }
                    echo ">" . $classRow['class_name'] . "</option>";
                } ?>
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
                <?php while ($studentRow = mysqli_fetch_assoc($studentResult)) { ?>
                    <tr>
                        <td><?php echo $studentRow['id']; ?></td>
                        <td><?php echo $studentRow['name']; ?></td>
                        <td><?php echo $studentRow['class_name']; ?></td>
                        <?php echo "<td><a href='../dashboard/profile.php?id=".$studentRow['id']."' class='btn btn-primary'>View</a><a href='../dashboard/delete.php?id=".$studentRow['id']."' class='btn btn-danger mx-1'>Delete</a></td>" ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</body>

</html>