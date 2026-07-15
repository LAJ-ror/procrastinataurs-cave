<?php

session_start();

require_once 'includes/db.php';
require_once 'includes/functions.php';

$message = "";
$remembered_email = $_COOKIE['remember_email'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['email'] = $row['email'];

            // Record login in audit log
            recordAudit(
                $conn,
                "Buyer",
                $_SESSION['user_id'],
                "User Logged In"
            );

            // Remember Me
            if (isset($_POST['remember_me'])) {
                setcookie('remember_email', $email, time() + (30 * 24 * 60 * 60), '/');
            } else {
                setcookie('remember_email', '', time() - 3600, '/');
            }

            header("Location: index.php");
            exit();

        } else {

            $message = "<div class='alert alert-danger'>
                            Incorrect password.
                        </div>";

        }

    } else {

        $message = "<div class='alert alert-danger'>
                        No account found with that email.
                    </div>";

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procrastinataurs' Cave</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="index.php" aria-label="Procrastinataurs' Cave Home">
            <img src="assets/images/Temp_Logo.svg" alt="Procrastinataurs' Cave logo" class="brand-logo">
            <span>Procrastinataurs’ Cave</span>
        </a>
    </div>
</header>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Login</h3>
                    <p class="text-muted">
                        Login to continue shopping.
                    </p>
                </div>

                <div class="card-body">

                    <?php echo $message; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                Email Address
                            </label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?php echo htmlspecialchars($remembered_email); ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3 form-check">
                            <input
                                type="checkbox"
                                name="remember_me"
                                class="form-check-input"
                                id="remember_me"
                                <?php if (!empty($remembered_email)) echo "checked"; ?>>

                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>

                        <div class="d-grid">
                            <button
                                type="submit"
                                class="btn btn-dark">
                                Login
                            </button>
                        </div>

                    </form>

                    <hr>

                    <p class="text-center">
                        Don't have an account?
                        <a href="register.php">
                            Register Here
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>

</body>
</html>