<?php
session_start();
// Security: Redirect if not logged in
if (!isset($_SESSION['teacher_logged_in'])) {
    header("Location: index.php");
    exit;
}

include_once '../config/database.php';
include_once '../src/Student.php';

// Get ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);

// Handle Form Submission
if ($_POST) {
    if($student->update($id, $_POST['name'], $_POST['email'], $_POST['grade'])){
        echo "<script>alert('Student updated successfully!'); window.location.href='index.php';</script>";
    } else {
        $error = "Unable to update student.";
    }
}

// Fetch current data to pre-fill the form
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
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">✏️ Edit Student</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Grade / Class</label>
                                <input type="text" name="grade" value="<?php echo htmlspecialchars($row['grade']); ?>" class="form-control" required>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-block">
                                <button type="submit" class="btn btn-warning">Update Student</button>
                                <a href="index.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>