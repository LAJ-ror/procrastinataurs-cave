<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
;

// Counts
$product_count = 0;
$user_count = 0;
$order_count = 0;
$stock_count = 0;

$product_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
if ($product_result) {
    $product_row = mysqli_fetch_assoc($product_result);
    $product_count = $product_row['total'];
}

$user_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
if ($user_result) {
    $user_row = mysqli_fetch_assoc($user_result);
    $user_count = $user_row['total'];
}

$order_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");
if ($order_result) {
    $order_row = mysqli_fetch_assoc($order_result);
    $order_count = $order_row['total'];
}

$stock_result = mysqli_query($conn, "SELECT SUM(stock) AS total_stock FROM products");
if ($stock_result) {
    $stock_row = mysqli_fetch_assoc($stock_result);
    $stock_count = $stock_row['total_stock'] ? $stock_row['total_stock'] : 0;
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procrastinataurs' Cave</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="../index.php" aria-label="Procrastinataurs' Cave Home">
            <img src="../assets/images/Temp_Logo.svg" alt="Procrastinataurs' Cave logo" class="brand-logo">
            <span>Procrastinataurs’ Cave</span>
        </a>
    </div>
</header>

<div class="container my-5">
    <h1 class="fw-bold mb-4">Admin Dashboard</h1>
    <p class="text-muted">Welcome, <?php echo $_SESSION['admin_name']; ?>.</p>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4">
                <h3><?php echo $product_count; ?></h3>
                <p class="mb-0">Total Products</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4">
                <h3><?php echo $user_count; ?></h3>
                <p class="mb-0">Total Users</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4">
                <h3><?php echo $order_count; ?></h3>
                <p class="mb-0">Total Orders</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4">
                <h3><?php echo $stock_count; ?></h3>
                <p class="mb-0">Remaining Stocks</p>
            </div>
        </div>
    </div>

    <div class="row mt-5 g-3">
        <div class="col-md-3">
            <a href="products.php" class="btn btn-dark w-100 py-3">Manage Products</a>
        </div>
        <div class="col-md-3">
            <a href="users.php" class="btn btn-dark w-100 py-3">Manage Admin Users</a>
        </div>
        <div class="col-md-3">
            <a href="inventory_report.php" class="btn btn-dark w-100 py-3">Inventory Report</a>
        </div>
        <div class="col-md-3">
            <a href="audit_logs.php" class="btn btn-dark w-100 py-3">Audit Logs</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
