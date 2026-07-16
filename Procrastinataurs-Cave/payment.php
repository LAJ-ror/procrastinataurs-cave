<?php
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];

// Get logged-in user info
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$user_id' LIMIT 1");
$user = mysqli_fetch_assoc($user_query);

// Selected items from cart
$selected_cart_ids = isset($_SESSION['selected_cart_ids']) ? $_SESSION['selected_cart_ids'] : [];

if (empty($selected_cart_ids)) {
    header("Location: cart.php");
    exit();
}

$message = "";

// Build safe IN clause
$selected_cart_ids = array_map('intval', $selected_cart_ids);
$ids = implode(',', $selected_cart_ids);

// Get selected cart items
$sql = "SELECT c.cart_id, c.quantity, p.product_id, p.product_name, p.price
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
} else {
    header("Location: cart.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $payment_method = sanitize($_POST['payment_method']);
    $reference_number = isset($_POST['reference_number']) ? sanitize($_POST['reference_number']) : '';
    $shipping_address = sanitize($_POST['shipping_address']);

    if (empty($shipping_address)) {
        $message = "<div class='alert alert-danger'>Please enter your shipping address.</div>";
    } else {

        // Payment status
        if ($payment_method === 'Cash on Delivery') {
            $payment_status = 'Pending';
            $reference_number = null;
        } else {
            $payment_status = 'Paid';
            if (empty($reference_number)) {
                $message = "<div class='alert alert-danger'>Please enter the reference number.</div>";
            }
        }

        if (empty($message)) {

            $reference_sql = is_null($reference_number) ? "NULL" : "'" . mysqli_real_escape_string($conn, $reference_number) . "'";
            $shipping_address_sql = mysqli_real_escape_string($conn, $shipping_address);
            $payment_method_sql = mysqli_real_escape_string($conn, $payment_method);
            $payment_status_sql = mysqli_real_escape_string($conn, $payment_status);

            // Insert order
            $order_sql = "INSERT INTO orders
                (user_id, total_amount, payment_method, reference_number, payment_status, shipping_address, order_status)
                VALUES
                ('$user_id', '$total', '$payment_method_sql', $reference_sql, '$payment_status_sql', '$shipping_address_sql', 'Processing')";

            if (mysqli_query($conn, $order_sql)) {

                $order_id = mysqli_insert_id($conn);

                // Insert order items
                foreach ($items as $item) {
                    $product_id = (int) $item['product_id'];
                    $quantity = (int) $item['quantity'];
                    $price = (float) $item['price'];

                    $item_sql = "INSERT INTO order_items
                        (order_id, product_id, quantity, price)
                        VALUES
                        ('$order_id', '$product_id', '$quantity', '$price')";
                    mysqli_query($conn, $item_sql);
                }

                // Clear purchased items from cart
                mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id' AND cart_id IN ($ids)");

                // Save receipt info in session
                $_SESSION['last_order_id'] = $order_id;
                $_SESSION['receipt_message'] = "Transaction Complete! Your order is being processed.";

                // Clear selected cart ids
                unset($_SESSION['selected_cart_ids']);

                header("Location: receipt.php");
                exit();

            } else {
                $message = "<div class='alert alert-danger'>Failed to place order.</div>";
            }
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Payment</h1>
        <p class="text-muted">Choose your preferred payment method.</p>
    </div>

    <?php echo $message; ?>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow mb-4">
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
                </div>
            </div>

            <form method="POST">

                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        Payment Details
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <textarea name="shipping_address"
                                      class="form-control"
                                      rows="4"
                                      required><?php echo htmlspecialchars($user['address']); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>

                            <div class="form-check mb-2">
                                <input class="form-check-input payment-method"
                                       type="radio"
                                       name="payment_method"
                                       value="Cash on Delivery"
                                       id="cod"
                                       checked>
                                <label class="form-check-label" for="cod">
                                    Cash on Delivery
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input payment-method"
                                       type="radio"
                                       name="payment_method"
                                       value="GCash"
                                       id="gcash">
                                <label class="form-check-label" for="gcash">
                                    GCash
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input payment-method"
                                       type="radio"
                                       name="payment_method"
                                       value="Bank Transfer"
                                       id="bank">
                                <label class="form-check-label" for="bank">
                                    Bank Transfer
                                </label>
                            </div>
                        </div>

                        <div class="mb-3" id="referenceBox" style="display:none;">
                            <label class="form-label">Reference Number</label>
                            <input type="text"
                                   name="reference_number"
                                   id="reference_number"
                                   class="form-control"
                                   placeholder="Enter payment reference number">
                            <small class="text-muted">
                                Required for GCash and Bank Transfer.
                            </small>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">
                            Confirm Payment
                        </button>

                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
const paymentMethods = document.querySelectorAll('.payment-method');
const referenceBox = document.getElementById('referenceBox');

function toggleReference() {
    const selected = document.querySelector('.payment-method:checked').value;
    if (selected === 'GCash' || selected === 'Bank Transfer') {
        referenceBox.style.display = 'block';
    } else {
        referenceBox.style.display = 'none';
    }
}

paymentMethods.forEach(radio => {
    radio.addEventListener('change', toggleReference);
});

toggleReference();
</script>

<?php include 'includes/footer.php';
 ?>