<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
?>

    <li class="nav-item">
        <a class="nav-link" href="cart.php">
            <i class="bi bi-cart"></i> Cart
        </a>
    </li>

    <li class="nav-item">
        <span class="nav-link">
            Hi, <?php echo htmlspecialchars($_SESSION['first_name']); ?>
        </span>
    </li>

    <li class="nav-item">
        <a class="btn btn-outline-dark ms-2" href="logout.php">
            Logout
        </a>
    </li>

<?php
} else {
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
            <button class="icon-button" type="button" aria-label="Search">⌕</button>
            <a class="sign-in-button" href="login.php">Log In</a>
        </div>
    </div>
</header>
<main>

<?php
}
?>
