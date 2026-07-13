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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="index.php" aria-label="Procrastinataurs' Cave Home">
            <!-- IMAGE PATH: Palitan ang assets/images/logo.png ng path ng logo mo -->
            <img src="assets/images/logo.png" alt="Procrastinataurs' Cave logo" class="brand-logo">
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

            <a href="categories.php"
            class="<?php if ($currentPage == 'categories') echo 'active'; ?>">
                Categories
            </a>

            <a href="about.php"
            class="<?php if ($currentPage == 'about') echo 'active'; ?>">
                About Us
            </a>
        </nav>

        <div class="header-actions">
            <!-- ICON/SVG: Palitan ang text icon sa loob ng button ng sarili mong icon o SVG -->
            <button class="icon-button" type="button" aria-label="Search">⌕</button>
            <a class="sign-in-button" href="#">Sign In</a>
        </div>
    </div>
</header>
<main>
