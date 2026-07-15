<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = "";
$remembered_email = isset($_COOKIE['admin_email']) ? $_COOKIE['admin_email'] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_name'] = $row['fullname'];
            $_SESSION['admin_email'] = $row['email'];

            if (isset($_POST['remember_me'])) {
                setcookie("admin_email", $row['email'], time() + (86400 * 7), "/");
            } else {
                setcookie("admin_email", "", time() - 3600, "/");
            }

            if (function_exists('recordAudit')) {
                recordAudit($conn, "Admin", $row['admin_id'], "Admin Logged In");
            }

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "<div class='alert alert-danger'>Incorrect password.</div>";
        }

    } else {
        $message = "<div class='alert alert-danger'>Admin account not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background:#f8f9fa;
        }
        .login-wrap{
            min-height:100vh;
            display:flex;
            align-items:center;
        }
    </style>
</head>
<body>

<div class="container login-wrap">
    <div class="row justify-content-center w-100">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center bg-dark text-white">
                    <h3 class="mb-0">Admin Login</h3>
                    <p class="mb-0 small">Login to access the admin panel</p>
                </div>

                <div class="card-body p-4">
                    <?php echo $message; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($remembered_email); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Remember Me
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
