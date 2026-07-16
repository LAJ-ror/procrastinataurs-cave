<?php
require_once 'includes/db.php';
require_once 'includes/session.php';

include 'includes/header.php';

$user_id = (int) $_SESSION['user_id'];

// Get cart items for this user
$sql = "SELECT c.cart_id, c.quantity, p.product_name, p.price
        FROM cart c
        INNER JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = '$user_id'
        ORDER BY c.cart_id DESC";

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

            <!-- Customer Information -->
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

            <!-- Order Summary -->
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

                        <a href="payment.php"
                           class="btn btn-dark w-100 mt-4">
                            Continue to Payment
                        </a>

                    </div>
                </div>

            </div>

        </div>

    <?php } else { ?>

        <div class="alert alert-info text-center">
            Your cart is empty.
        </div>

        <div class="text-center">
            <a href="shop.php" class="btn btn-dark">
                Continue Shopping
            </a>
        </div>

    <?php } ?>

</div>

<?php
include 'includes/footer.php';
?>
