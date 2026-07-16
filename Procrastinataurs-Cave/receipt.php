<?php
require_once 'includes/db.php';
require_once 'includes/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['last_order_id'])) {
    header("Location: shop.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];
$order_id = (int) $_SESSION['last_order_id'];

$order_query = mysqli_query(
    $conn,
    "SELECT o.*, u.first_name, u.last_name
     FROM orders o
     INNER JOIN users u ON o.user_id = u.user_id
     WHERE o.order_id = '$order_id' AND o.user_id = '$user_id'
     LIMIT 1"
);

if (!$order_query || mysqli_num_rows($order_query) == 0) {
    header("Location: shop.php");
    exit();
}

$order = mysqli_fetch_assoc($order_query);

$items_query = mysqli_query(
    $conn,
    "SELECT oi.*, p.product_name
     FROM order_items oi
     INNER JOIN products p ON oi.product_id = p.product_id
     WHERE oi.order_id = '$order_id'"
);

$order_number = "ORD-" . date("Ymd", strtotime($order['created_at'])) . "-" . str_pad($order_id, 4, "0", STR_PAD_LEFT);
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">

    <div class="alert alert-success text-center">
        <h4 class="mb-1">Transaction Complete!</h4>
        <p class="mb-0">Your order is being processed.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            Receipt
        </div>

        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Receipt No:</strong> <?php echo $order_number; ?></p>
                    <p><strong>Customer:</strong> <?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></p>
                    <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
                </div>

                <div class="col-md-6">
                    <p><strong>Reference Number:</strong> <?php echo !empty($order['reference_number']) ? htmlspecialchars($order['reference_number']) : 'N/A'; ?></p>
                    <p><strong>Payment Status:</strong> <?php echo htmlspecialchars($order['payment_status']); ?></p>
                    <p><strong>Order Status:</strong> <?php echo htmlspecialchars($order['order_status']); ?></p>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">Items</h5>

            <?php while ($item = mysqli_fetch_assoc($items_query)) { ?>
                <div class="d-flex justify-content-between mb-2">
                    <div>
                        <?php echo htmlspecialchars($item['product_name']); ?>
                        <small class="text-muted d-block">Qty: <?php echo $item['quantity']; ?></small>
                    </div>
                    <div>
                        ₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                    </div>
                </div>
            <?php } ?>

            <hr>

            <h4 class="text-end">
                Total: ₱<?php echo number_format($order['total_amount'], 2); ?>
            </h4>

            <div class="text-center mt-4">
                <a href="shop.php" class="btn btn-dark me-2">Continue Shopping</a>
                <a href="orders.php" class="btn btn-outline-dark">View My Orders</a>
            </div>

        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>