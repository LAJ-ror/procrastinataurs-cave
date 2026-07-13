<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$admin_id = intval($_GET['id']);

$user_query = mysqli_query($conn, "SELECT * FROM admins WHERE admin_id='$admin_id'");
if (!$user_query || mysqli_num_rows($user_query) == 0) {
    header("Location: users.php");
    exit();
}

$user = mysqli_fetch_assoc($user_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = sanitize($_POST['fullname']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email' AND admin_id != '$admin_id'");
    if ($check && mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Email already exists.</div>";
    } else {

        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE admins
                    SET fullname='$fullname', email='$email', password='$hashedPassword'
                    WHERE admin_id='$admin_id'";
        } else {
            $sql = "UPDATE admins
                    SET fullname='$fullname', email='$email'
                    WHERE admin_id='$admin_id'";
        }

        if (mysqli_query($conn, $sql)) {
            header("Location: users.php");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Failed to update admin.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">Procrastinataurs' Cave - Admin</a>
        <a href="users.php" class="btn btn-outline-light btn-sm">Back to Users</a>
    </div>
</nav>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Edit Admin</h4>
                </div>
                <div class="card-body">
                    <?php echo $message; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fullname" class="form-control"
                                   value="<?php echo $user['fullname']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                   value="<?php echo $user['email']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Leave blank if no change">
                        </div>

                        <button type="submit" class="btn btn-dark">Update Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
