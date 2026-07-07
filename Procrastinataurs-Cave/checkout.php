<?php
include 'includes/header.php';
?>

<div class="container my-5">

    <h1 class="text-center fw-bold mb-5">

        Checkout

    </h1>

    <div class="row">

        <!-- Customer Information -->

        <div class="col-lg-7">

            <div class="card shadow-sm mb-4">

                <div class="card-header bg-dark text-white">

                    Customer Information

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Full Name

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Juan Dela Cruz">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Contact Number

                        </label>

                        <input
                            type="tel"
                            class="form-control"
                            placeholder="09XXXXXXXXX">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Complete Address

                        </label>

                        <textarea
                            class="form-control"
                            rows="4"></textarea>

                    </div>

                </div>

            </div>

        </div>

        <!-- Order Summary -->

        <div class="col-lg-5">

            <div class="card shadow-sm">

                <div class="card-header bg-dark text-white">

                    Order Summary

                </div>

                <div class="card-body">

                    <p>

                        Classic Backpack

                        <span class="float-end">

                            ₱1,499.00

                        </span>

                    </p>

                    <hr>

                    <h5>

                        Total

                        <span class="float-end">

                            ₱1,499.00

                        </span>

                    </h5>

                    <a href="payment.php"
                       class="btn btn-dark w-100 mt-4">

                        Continue to Payment

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include 'includes/footer.php';
?>