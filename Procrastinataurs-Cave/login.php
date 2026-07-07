<?php

session_start();

require_once 'includes/db.php';
require_once 'includes/functions.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email'"
    );
    recordAudit(
    $conn,
    "Buyer",
    $_SESSION['user_id'],
    "User Logged In"
);

    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['email'] = $row['email'];

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

include 'includes/header.php';

?>

<div class="container my-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Login</h3>
                    <p class="text-muted mb-0">Login to continue shopping.</p>
                </div>

                <div class="card-body">

                    <?php echo $message; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>
                            </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>

                    </form>

                    <hr>

                    <p class="text-center mb-0">
                        Don't have an account?
                        <a href="register.php">Register here</a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

    <a href="register.php">

        Register here

    </a>
</div>

<?php include 'includes/footer.php'; ?>