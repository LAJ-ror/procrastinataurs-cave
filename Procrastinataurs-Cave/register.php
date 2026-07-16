<?php

require_once 'includes/db.php';
require_once 'includes/functions.php';
require_once 'mailer.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ==========================
    // Personal Information
    // ==========================

    $first_name = sanitize($_POST['first_name']);
    $middle_name = sanitize($_POST['middle_name']);
    $last_name = sanitize($_POST['last_name']);
    $suffix = sanitize($_POST['suffix']);
    $birthdate = $_POST['birthdate'];
    $gender = sanitize($_POST['gender']);

    // ==========================
    // Account Information
    // ==========================

    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $token = bin2hex(random_bytes(32));

    if ($password !== $confirm_password) {

        $message = "<div class='alert alert-danger'>
                        Passwords do not match.
                    </div>";

    } else {

        $Password = $password;

    }

    // ==========================
    // Contact Information
    // ==========================

    $address = sanitize($_POST['address']);
    $contact = sanitize($_POST['contact']);

    // ==========================
    // Validation
    // ==========================

    if ($password !== $confirm_password) {

        $message = "<div class='alert alert-danger'>
                        Passwords do not match.
                    </div>";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $message = "<div class='alert alert-danger'>
                            Invalid email address.
                        </div>";

        }

    } else {

        // Check duplicate email
        $checkEmail = mysqli_query(
            $conn,
            "SELECT * FROM users WHERE email='$email'"
        );

        $userId = mysqli_insert_id($conn);

        recordAudit(
            $conn,
            "Buyer",
            $userId,
            "User Registered"
        );

        if (mysqli_num_rows($checkEmail) > 0) {

            $message = "<div class='alert alert-danger'>
                            Email already exists.
                        </div>";

        } else {

            /* =========================================
               DATABASE INSERT
            ========================================= */

            $sql = "INSERT INTO users
            (
              first_name,
              middle_name,
              last_name,
              suffix,
              birthdate,
              gender,
              email,
              password,
              address,
              contact,
              verification_code,
              is_verified
           )
            VALUES
            (
              '$first_name',
              '$middle_name',
              '$last_name',
              '$suffix',
              '$birthdate',
              '$gender',
              '$email',
              '$password',
              '$address',
              '$contact',
              '$token',
               0
            )";

            if (mysqli_query($conn, $sql)) {

                sendVerificationEmail($email, $token);

                echo "<script>

                    alert('Registration successful! Please check your email.');

                    window.location='login.php';

                </script>";

                exit();

            } else {

                $message = "<div class='alert alert-danger'>
                                Registration Failed.
                            </div>";

            }

        }

    }

}

include 'includes/header.php';

?>

<div class="container my-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header text-center">

                    <h3>Create Account</h3>

                    <p class="text-muted">
                        Register to start shopping.
                    </p>

                </div>

                <div class="card-body">

                    <?php echo $message; ?>

                    <form method="POST">

                        <!-- ========================= -->
                        <!-- Personal Information -->
                        <!-- ========================= -->

                        <h5 class="border-bottom pb-2 mb-4">
                            Personal Information
                        </h5>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Middle Name
                                </label>

                                <input
                                    type="text"
                                    name="middle_name"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                    required>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Suffix
                                </label>

                                <select
                                    name="suffix"
                                    class="form-select">

                                    <option value="">
                                        None
                                    </option>

                                    <option value="Jr.">
                                        Jr.
                                    </option>

                                    <option value="Sr.">
                                        Sr.
                                    </option>

                                    <option value="II">
                                        II
                                    </option>

                                    <option value="III">
                                        III
                                    </option>

                                    <option value="IV">
                                        IV
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Date of Birth
                                </label>

                                <input
                                    type="date"
                                    name="birthdate"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Gender
                                </label>

                                <select
                                    name="gender"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option value="Male">
                                        Male
                                    </option>

                                    <option value="Female">
                                        Female
                                    </option>

                                    <option value="Prefer not to say">
                                        Prefer not to say
                                    </option>

                                </select>

                            </div>

                        </div>

                        <!-- ========================= -->
                        <!-- Account Information -->
                        <!-- ========================= -->

                        <h5 class="border-bottom pb-2 mt-4 mb-4">
                            Account Information
                        </h5>

                        <div class="mb-3">

                            <label class="form-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Confirm Password
                                </label>

                                <input
                                    type="password"
                                    name="confirm_password"
                                    class="form-control"
                                    required>

                            </div>

                        </div>

                        <!-- ========================= -->
                        <!-- Contact Information -->
                        <!-- ========================= -->

                        <h5 class="border-bottom pb-2 mt-4 mb-4">
                            Contact Information
                        </h5>

                        <div class="mb-3">

                            <label class="form-label">
                                Complete Address
                            </label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
                                required></textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Contact Number
                            </label>

                            <input
                                type="text"
                                name="contact"
                                class="form-control"
                                required>

                        </div>

                        <div class="d-grid mt-4">

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg">

                                Create Account

                            </button>

                        </div>

                    </form>

                    <hr>

                    <p class="text-center mb-0">

                        Already have an account?

                        <a href="login.php">
                            Login here
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>