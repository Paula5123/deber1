<?php
session_start();
include_once '../config/database.php';
include_once '../src/Teacher.php';
include_once '../src/Student.php';

$database = new Database();
$db = $database->getConnection();

// Handle Logout
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_destroy();
    header("Location: index.php");
    exit;
}

// --- LOGIN VIEW ---
if (!isset($_SESSION['teacher_logged_in'])) {
    if ($_POST) {
        $teacher = new Teacher($db);
        if ($teacher->login($_POST['username'], $_POST['password'])) {
            $_SESSION['teacher_logged_in'] = true;
            header("Location: index.php");
        } else {
            $error = "Invalid credentials";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Teacher Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            <h3 class="text-center mb-4">Teacher Login</h3>
            <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="mt-3 text-center">
                <small><a href="register_teacher.php">Register new account</a></small>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// --- DASHBOARD VIEW ---
$student = new Student($db);
$stmt = $student->readAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">🏫 School System</a>
            <div class="d-flex">
                <a href="index.php?action=logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Classroom Dashboard</h2>
            <a href="create.php" class="btn btn-success">+ Add Student</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Grade</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><span class="badge bg-info text-dark"><?php echo htmlspecialchars($row['grade']); ?></span></td>
                            <td>
                                <a href="read.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info text-white">View</a>
                                <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>