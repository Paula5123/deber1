<?php
session_start();

// Security: Only logged-in teachers can delete
if (!isset($_SESSION['teacher_logged_in'])) {
    header("Location: index.php");
    exit;
}

include_once '../config/database.php';
include_once '../src/Student.php';

// Check if ID is provided
if (isset($_GET['id'])) {
    $database = new Database();
    $db = $database->getConnection();
    $student = new Student($db);

    // Attempt delete
    if ($student->delete($_GET['id'])) {
        // Success: Redirect back to index
        header("Location: index.php?msg=deleted");
    } else {
        // Failure: Show error
        echo "Unable to delete student.";
    }
} else {
    // If someone tries to visit delete.php without an ID
    header("Location: index.php");
}
?>