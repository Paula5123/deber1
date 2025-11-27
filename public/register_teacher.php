<?php
include_once '../config/database.php';
include_once '../src/Teacher.php';

$database = new Database();
$db = $database->getConnection();
$teacher = new Teacher($db);
$message = "";

if ($_POST) {
    // Attempt to register
    if($teacher->register($_POST['username'], $_POST['password'])) {
        $message = "<div class='alert alert-success'>Teacher registered successfully! <a href='index.php' class='alert-link'>Login here</a>.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: Username may already exist.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <h3>📝 Register Teacher</h3>
            <p class="text-muted">Create an account to manage classes</p>
        </div>

        <?php echo $message; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Choose a username" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Create a password" required>
            </div>
            
            <button type="submit" class="btn btn-dark w-100">Register Account</button>
        </form>
        
        <div class="mt-3 text-center border-top pt-3">
            <small>Already have an account? <a href="index.php">Login here</a></small>
        </div>
    </div>

</body>
</html>