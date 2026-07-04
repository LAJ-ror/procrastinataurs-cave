<?php

require_once 'includes/db.php';
require_once 'includes/functions.php';

if(isset($_POST['register']))
{

    echo "Form Submitted!";

}

include 'includes/header.php';

?>

<div class="container my-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header text-center">

                    <h2>Create Account</h2>

                    <p class="text-muted">
                        Register to start shopping.
                    </p>

                </div>

                <div class="card-body">

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Complete Name</label>

                            <input
                                type="text"
                                name="fullname"
                                class="form-control"
                                required>
                        </div>

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

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>

                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Complete Address</label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
                                required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>

                            <input
                                type="text"
                                name="contact"
                                class="form-control"
                                required>
                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                name="register"
                                class="btn btn-primary">

                                Register

                            </button>

                        </div>

                    </form>

                    <hr>

                    <p class="text-center">

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

<?php
include 'includes/footer.php';
?>