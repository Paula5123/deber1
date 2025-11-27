<?php
session_start();
// Security: Redirect if not logged in
if (!isset($_SESSION['teacher_logged_in'])) {
    header("Location: index.php");
    exit;
}

include_once '../config/database.php';
include_once '../src/Student.php';

// Get ID
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

// Fetch student data
$row = $student->readOne($id);

if(!$row){
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow text-center">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Student Profile</h4>
                    </div>
                    <div class="card-body">
                        <!-- Profile Icon -->
                        <div class="mb-3">
                            <span style="font-size: 4rem;">🎓</span>
                        </div>
                        
                        <h3 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h3>
                        <p class="text-muted mb-4"><?php echo htmlspecialchars($row['email']); ?></p>
                        
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Student ID:</strong>
                                <span><?php echo $row['id']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Current Grade:</strong>
                                <span class="badge bg-primary rounded-pill"><?php echo htmlspecialchars($row['grade']); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Date Registered:</strong>
                                <span><?php echo date('M d, Y', strtotime($row['created_at'])); ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="index.php" class="btn btn-secondary btn-sm">Back to Dashboard</a>
                        <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>