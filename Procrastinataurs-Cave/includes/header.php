<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Procrastinataurs' Cave</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

    <div class="container">

        <!-- Logo -->

        <a class="navbar-brand fw-bold d-flex align-items-center"
           href="index.php">

            <!-- Replace this later with your SVG logo -->
            <i class="bi bi-handbag-fill fs-3 me-2"></i>

            Procrastinataurs' Cave

        </a>

        <!-- Mobile Toggle -->

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <!-- Left Menu -->

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a class="nav-link"
                       href="index.php">

                        Home

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="shop.php">

                        Shop

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="about.php">

                        About Us

                    </a>

                </li>

                <?php if(isset($_SESSION['user_id'])) { ?>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="cart.php">

                            <i class="bi bi-cart"></i>

                            Cart

                        </a>

                    </li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown">

                            Hi,
                            <?php echo $_SESSION['first_name']; ?>

                        </a>

                        <ul class="dropdown-menu">

                            <li>

                                <a class="dropdown-item"
                                   href="orders.php">

                                    My Orders

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item"
                                   href="logout.php">

                                    Logout

                                </a>

                            </li>

                        </ul>

                    </li>

                <?php } else { ?>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="login.php">

                            Login

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="btn btn-dark ms-2"
                           href="register.php">

                            Register

                        </a>

                    </li>

                <?php } ?>

            </ul>

        </div>

    </div>

</nav>