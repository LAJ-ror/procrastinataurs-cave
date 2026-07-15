<?php
include 'includes/header.php';
?>

<div class="container my-5">

    <div class="text-center mb-5">

        <h1 class="fw-bold">
            Payment
        </h1>

        <p class="text-muted">
            Choose your preferred payment method.
        </p>

    </div>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">

                    Payment Method

                </div>

                <div class="card-body">

                    <div class="form-check mb-3">

                        <input class="form-check-input"
                               type="radio"
                               name="payment_method"
                               id="cod"
                               checked>

                        <label class="form-check-label"
                               for="cod">

                            Cash on Delivery

                        </label>

                    </div>

                    <div class="form-check mb-3">

                        <input class="form-check-input"
                               type="radio"
                               name="payment_method"
                               id="gcash">

                        <label class="form-check-label"
                               for="gcash">

                            GCash

                        </label>

                    </div>

                    <div class="form-check mb-4">

                        <input class="form-check-input"
                               type="radio"
                               name="payment_method"
                               id="bank">

                        <label class="form-check-label"
                               for="bank">

                            Bank Transfer (Maya, GoTyme, MariBank, etc.)

                        </label>

                    </div>

                 <hr>

            <div class="mb-3">

                <label class="form-label">

                        Reference Number

                </label>
    
                    <input
                        type="text"
                        name="reference_number"
                        class="form-control"
                        placeholder="Enter your GCash/Bank reference number">
                
                    <small class="text-muted">
                
                        Required only for GCash or Bank Transfer payments.
                
                    </small>

                    </div>
                    <button
                        class="btn btn-dark w-100">

                        Confirm Payment

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include 'includes/footer.php';
?>
