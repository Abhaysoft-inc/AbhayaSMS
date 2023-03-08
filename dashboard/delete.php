<?php
include_once("../config.php");

// Check if the ID parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // First, delete related rows from the fee table
    $fee_sql = "DELETE FROM fee WHERE student_id = $id";
    mysqli_query($conn, $fee_sql);

    // Then, delete the student from the students table
    $sql = "DELETE FROM students WHERE id = $id";
    mysqli_query($conn, $sql);

    // Redirect to the student list page
    header('location: students.php');
    exit;
}
?>
