<?php

require_once 'includes/db.php';

$message = "";

if (isset($_GET['token'])) {

    $token = mysqli_real_escape_string($conn, $_GET['token']);

    $sql = "SELECT * FROM users
            WHERE verification_code='$token'
            LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if ($row['is_verified'] == 0) {

            $update = "UPDATE users
                       SET is_verified = 1,
                           verification_code = NULL
                       WHERE verification_code='$token'";

            if (mysqli_query($conn, $update)) {

                $message = "
                    <div class='alert alert-success'>
                        Your account has been verified successfully!
                    </div>";

            } else {

                $message = "
                    <div class='alert alert-danger'>
                        Verification failed.
                    </div>";

            }

        } else {

            $message = "
                <div class='alert alert-warning'>
                    Your account has already been verified.
                </div>";

        }

    } else {

        $message = "
            <div class='alert alert-danger'>
                Invalid or expired verification link.
            </div>";

    }

} else {

    $message = "
        <div class='alert alert-warning'>
            No verification token found.
        </div>";

}

include 'includes/header.php';
?>

<div class="container my-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <?php echo $message; ?>

            <div class="text-center mt-4">

                <a href="login.php" class="btn btn-dark">

                    Go to Login

                </a>

            </div>

        </div>

    </div>

</div>

<?php
include 'includes/footer.php';
?>