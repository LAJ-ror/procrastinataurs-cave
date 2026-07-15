<?php
$currentPage = "about";

require_once 'includes/db.php';
include 'includes/header.php';
?>

<div class="container my-5">

    <!-- Page Title -->

    <div class="text-center mb-5">

        <h1 class="fw-bold">
            About Us
        </h1>

        <p class="text-muted">
            Learn more about our company and our team.
        </p>

    </div>

    <!-- Company -->

    <div class="row align-items-center mb-5">

        <div class="col-md-6">

            <img src="assets/images/about.jpg"
                 class="img-fluid rounded shadow">

        </div>

        <div class="col-md-6">

            <h3>

                Procrastinataurs' Cave

            </h3>

            <p>

                Procrastinataurs' Cave is a student-developed
                online bag store that offers stylish,
                durable, and affordable bags for every occasion.

            </p>

            <p>

                This website was created as part of our
                Final Project in Application Development and Emerging Technologies.

            </p>

        </div>

    </div>

    <!-- Team -->

    <div class="text-center mb-5">

        <h2>

            Meet Our Team

        </h2>

    </div>

    <div class="row">

        <div class="col-md-4 mb-4">

            <div class="card shadow text-center">

                <div class="card-body">

                    <img src="assets/images/profile1.png"
                         class="rounded-circle mb-3"
                         width="120">

                    <h5>

                        Lei Caabay

                    </h5>

                    <p class="text-muted">

                        Frontend Developer

                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow text-center">

                <div class="card-body">

                    <img src="assets/images/profile2.png"
                         class="rounded-circle mb-3"
                         width="120">

                    <h5>

                       Angelika Magandingan

                    </h5>

                    <p class="text-muted">

                        Backend Developer

                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow text-center">

                <div class="card-body">

                    <img src="assets/images/profile3.png"
                         class="rounded-circle mb-3"
                         width="120">

                    <h5>

                       Juliana Rey

                    </h5>

                    <p class="text-muted">

                        System Administrator

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include 'includes/footer.php';
?>
