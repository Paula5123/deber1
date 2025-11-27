<?php
session_start();
if (!isset($_SESSION['teacher_logged_in'])) header("Location: index.php");

include_once '../config/database.php';
include_once '../src/Student.php';

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    $student = new Student($db);

    if($student->create($_POST['name'], $_POST['email'], $_POST['grade'])){
        header("Location: index.php");
    } else {
        $error = "Error adding student.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Add New Student</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Grade / Class</label>
                                <input type="text" name="grade" class="form-control" placeholder="e.g. 10th Grade" required>
                            </div>
                            <button type="submit" class="btn btn-success">Save Student</button>
                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>