<?php
require_once 'includes/db.php';
require_once 'includes/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/header.php';

$user_id = (int) $_SESSION['user_id'];

// Receive selected items from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_items'])) {
    $_SESSION['selected_cart_ids'] = array_map('intval', $_POST['selected_items']);
    header("Location: checkout.php");
    exit();
}

$selected_cart_ids = isset($_SESSION['selected_cart_ids']) ? $_SESSION['selected_cart_ids'] : [];

if (empty($selected_cart_ids)) {
    ?>
    <div class="container my-5">
        <div class="alert alert-info text-center">
            No items selected for checkout.
        </div>
        <div class="text-center">
            <a href="cart.php" class="btn btn-dark">Back to Cart</a>
        </div>
    </div>
    <?php
    include 'includes/footer.php';
    exit();
}

// Convert selected IDs to comma-separated string
$ids = implode(',', array_map('intval', $selected_cart_ids));

$sql = "SELECT c.cart_id, c.quantity, p.product_name, p.price
        FROM cart c
        INNER JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = '$user_id'
        AND c.cart_id IN ($ids)";

$result = mysqli_query($conn, $sql);

$items = [];
$total = 0;

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
        $items[] = $row;
    }
}
?>

<div class="container my-5">

    <h1 class="text-center fw-bold mb-5">
        Checkout
    </h1>

    <?php if (!empty($items)) { ?>

        <div class="row">

            <div class="col-lg-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        Customer Information
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="Juan Dela Cruz">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" placeholder="09XXXXXXXXX">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Complete Address</label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        Order Summary
                    </div>

                    <div class="card-body">

                        <?php foreach ($items as $item) { ?>
                            <p class="mb-2">
                                <?php echo htmlspecialchars($item['product_name']); ?>
                                <span class="float-end">
                                    ₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                                </span>
                            </p>

                            <small class="text-muted d-block mb-2">
                                Quantity: <?php echo $item['quantity']; ?>
                            </small>

                            <hr>
                        <?php } ?>

                        <h5>
                            Total
                            <span class="float-end">
                                ₱<?php echo number_format($total, 2); ?>
                            </span>
                        </h5>

                        <a href="payment.php" class="btn btn-dark w-100 mt-4">
                            Continue to Payment
                        </a>

                    </div>
                </div>
            </div>

        </div>

    <?php } else { ?>

        <div class="alert alert-info text-center">
            No valid selected items were found.
        </div>

        <div class="text-center">
            <a href="cart.php" class="btn btn-dark">Back to Cart</a>
        </div>

    <?php } ?>

</div>

<?php include 'includes/footer.php'; ?>
