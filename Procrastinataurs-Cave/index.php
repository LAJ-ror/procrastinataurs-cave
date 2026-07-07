<?php
require_once 'includes/db.php';
include 'includes/header.php';
?>

<!-- ========================================= -->
<!-- Hero Section -->
<!-- ========================================= -->

<section class="hero-section py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-md-6">

                <h1 class="display-4 fw-bold">

                    Carry Style Everywhere

                </h1>

                <p class="lead">

                    Discover stylish bags designed for
                    everyday life and every journey.

                </p>

                <a href="shop.php"
                   class="btn btn-dark btn-lg">

                    Shop Now

                </a>

            </div>

            <div class="col-md-6 text-center">

                <img src="assets/images/banner.jpg"
                     class="img-fluid"
                     alt="Banner">

            </div>

        </div>

    </div>

</section>

<!-- ========================================= -->
<!-- Featured Products -->
<!-- ========================================= -->

<section class="py-5">

    <div class="container">

        <h2 class="text-center mb-5">

            Featured Products

        </h2>

        <div class="row">

            <?php
            for($i=1;$i<=4;$i++){
            ?>

            <div class="col-md-3 mb-4">

                <div class="card shadow h-100">

                    <img src="assets/images/products/product.jpg"
                         class="card-img-top"
                         alt="Product">

                    <div class="card-body">

                        <h5 class="card-title">

                            Sample Bag

                        </h5>

                        <p>

                            ₱1,499.00

                        </p>

                        <a href="shop.php"
                           class="btn btn-outline-dark w-100">

                            View Product

                        </a>

                    </div>

                </div>

            </div>

            <?php
            }
            ?>

        </div>

    </div>

</section>

<!-- ========================================= -->
<!-- Categories -->
<!-- ========================================= -->

<section class="bg-light py-5">

    <div class="container">

        <h2 class="text-center mb-5">

            Categories

        </h2>

        <div class="row text-center">

            <div class="col-md-3">

                <h4>🎒</h4>

                <h5>Backpacks</h5>

            </div>

            <div class="col-md-3">

                <h4>👜</h4>

                <h5>Handbags</h5>

            </div>

            <div class="col-md-3">

                <h4>💼</h4>

                <h5>Travel Bags</h5>

            </div>

            <div class="col-md-3">

                <h4>🧳</h4>

                <h5>Luggage</h5>

            </div>

        </div>

    </div>

</section>

<!-- ========================================= -->
<!-- Why Choose Us -->
<!-- ========================================= -->

<section class="py-5">

    <div class="container">

        <h2 class="text-center mb-5">

            Why Choose Us

        </h2>

        <div class="row text-center">

            <div class="col-md-4">

                <i class="bi bi-truck fs-1"></i>

                <h5 class="mt-3">

                    Fast Delivery

                </h5>

                <p>

                    Receive your orders quickly and safely.

                </p>

            </div>

            <div class="col-md-4">

                <i class="bi bi-shield-check fs-1"></i>

                <h5 class="mt-3">

                    Secure Shopping

                </h5>

                <p>

                    Your information is protected.

                </p>

            </div>

            <div class="col-md-4">

                <i class="bi bi-star-fill fs-1"></i>

                <h5 class="mt-3">

                    Quality Products

                </h5>

                <p>

                    Premium bags at affordable prices.

                </p>

            </div>

        </div>

    </div>

</section>

<?php
include 'includes/footer.php';
?>