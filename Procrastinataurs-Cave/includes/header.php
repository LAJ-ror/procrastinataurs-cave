<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Procrastinataurs' Cave</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->

    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body>
    <div class="top-bar">
    <div class="brand">
        <a href="admin/login.php" class="seller-link">
            Seller Center
        </a>

    </div>

</div>

<header class="site-header">
    <div class="header-inner">
        <a class="brand"
           href="index.php">
            <img src="assets/images/Temp_Logo.svg"
                 class="brand-logo"
                 alt="Logo">
            <span>
                Procrastinataurs' Cave
            </span>
        </a>
        <nav class="nav-links">
            <a href="index.php"
               class="<?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>">
                Home
            </a>

            <a href="shop.php"
               class="<?php echo ($currentPage == 'shop.php') ? 'active' : ''; ?>">
                Shop
            </a>

            <a href="about.php"
               class="<?php echo ($currentPage == 'about.php') ? 'active' : ''; ?>">
                About Us
            </a>

        </nav>

        <div class="header-actions">
        <?php if(isset($_SESSION['user_id'])) { ?>
            <a href="cart.php"
               class="icon-button">
                <i class="bi bi-cart"></i>
                Cart
            </a>
            <span class="me-2">
                Hi,
                <?php echo htmlspecialchars($_SESSION['first_name']); ?>
            </span>

            <a href="logout.php"
               class="sign-in-button">
                Logout
            </a>

        <?php } else { ?>

            <a href="login.php"
               class="sign-in-button">
                Login
            </a>

        <?php } ?>

        </div>
    </div>

</header>

<main>