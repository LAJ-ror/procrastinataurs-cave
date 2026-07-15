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

$sql = "SELECT * FROM admins ORDER BY admin_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">Procrastinataurs' Cave - Admin</a>
        <div>
            <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
            <a href="add_user.php" class="btn btn-warning btn-sm me-2">Add Admin</a>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Users</h2>
        <a href="add_user.php" class="btn btn-dark">+ Add Admin</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['admin_id']; ?></td>
                                <td><?php echo $row['fullname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <a href="edit_user.php?id=<?php echo $row['admin_id']; ?>" class="btn btn-primary btn-sm me-1">Edit</a>
                                    <a href="delete_user.php?id=<?php echo $row['admin_id']; ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Delete this admin account?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } 
?>
                    <?php }
else { 
    ?>
        <tr>
         <td colspan="5" class="text-center">No admin users found.</td>
             </tr>
                 <?php }
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
