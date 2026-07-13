<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procrastinataurs' Cave</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="index.php" aria-label="Procrastinataurs' Cave Home">
            <!-- IMAGE PATH: Palitan ang assets/images/logo.png ng path ng logo mo -->
            <img src="assets/images/Temp_Logo.svg" alt="Procrastinataurs' Cave logo" class="brand-logo">
            <span>Procrastinataurs’ Cave</span>
        </a>

        <nav class="nav-links">
            <a href="index.php"
            class="<?php if ($currentPage == 'home') echo 'active'; ?>">
                Home
            </a>

            <a href="shop.php"
            class="<?php if ($currentPage == 'shop') echo 'active'; ?>">
                Shop
            </a>

            <a href="about.php"
            class="<?php if ($currentPage == 'about') echo 'active'; ?>">
                About Us
            </a>
        </nav>

        <div class="header-actions">
            <!-- ICON/SVG: Palitan ang text icon sa loob ng button ng sarili mong icon o SVG -->
            <button class="icon-button" type="button" aria-label="Search">⌕</button>
            <a class="sign-in-button" href="login.php">Sign In</a>
        </div>
    </div>
</header>
<main>
