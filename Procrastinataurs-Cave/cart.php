<?php
require_once 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';

$user_id = (int) $_SESSION['user_id'];

$sql = "SELECT c.cart_id, c.quantity, p.product_id, p.product_name, p.price, p.image
        FROM cart c
        INNER JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = '$user_id'
        ORDER BY c.cart_id DESC";

$result = mysqli_query($conn, $sql);

$total = 0;
?>

<div class="container my-5">

    <h1 class="text-center fw-bold mb-5">
        Shopping Cart
    </h1>

    <?php if ($result && mysqli_num_rows($result) > 0) { ?>

        <form action="checkout.php" method="POST">

            <div class="card shadow-sm">
                <div class="card-body table-responsive">

                    <table class="table align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Select</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <?php
                                    $subtotal = $row['price'] * $row['quantity'];
                                    $total += $subtotal;
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               name="selected_items[]"
                                               value="<?php echo $row['cart_id']; ?>"
                                               checked>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if (!empty($row['image'])) { ?>
                                                <img src="assets/images/bag_photos/<?php echo htmlspecialchars($row['image']); ?>"
                                                     width="80"
                                                     height="80"
                                                     class="me-3 rounded"
                                                     style="object-fit: cover;"
                                                     alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                                            <?php } else { ?>
                                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                     style="width:80px; height:80px;">
                                                    No Img
                                                </div>
                                            <?php } ?>

                                            <div>
                                                <strong><?php echo htmlspecialchars($row['product_name']); ?></strong>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        ₱<?php echo number_format($row['price'], 2); ?>
                                    </td>

                                    <td>
                                        <?php echo $row['quantity']; ?>
                                    </td>

                                    <td>
                                        ₱<?php echo number_format($subtotal, 2); ?>
                                    </td>

                                    <td>
                                        <a href="remove_from_cart.php?cart_id=<?php echo $row['cart_id']; ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Remove this item from cart?');">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row justify-content-end mt-4">
                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            Order Summary
                        </div>

                        <div class="card-body">
                            <p class="mb-3">
                                Total
                                <span class="float-end">
                                    ₱<?php echo number_format($total, 2); ?>
                                </span>
                            </p>

                            <hr>

                            <button type="submit" class="btn btn-dark w-100">
                                Checkout Selected Items
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

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

<?php include 'includes/footer.php'; ?>
