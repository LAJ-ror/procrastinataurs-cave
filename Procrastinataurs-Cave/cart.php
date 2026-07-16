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

        <div class="card shadow-sm">
            <div class="card-body table-responsive">

                <table class="table align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th style="width: 160px;">Quantity</th>
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
                                    <div class="d-flex align-items-center">
                                        <?php if (!empty($row['image'])) { ?>
                                            <img src="assets/images/bag_photos/<?php echo htmlspecialchars($row['image']); ?>"
                                                 width="80"
                                                 height="80"
                                                 class="me-3 rounded"
                                                 style="object-fit: cover;">
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

                                <td>₱<?php echo number_format($row['price'], 2); ?></td>

                                <td>
                                    <form action="update_cart.php" method="POST" class="d-flex">
                                        <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                        <input type="number"
                                               name="quantity"
                                               value="<?php echo $row['quantity']; ?>"
                                               min="1"
                                               class="form-control form-control-sm me-2">
                                        <button type="submit" class="btn btn-sm btn-outline-dark">
                                            Update
                                        </button>
                                    </form>
                                </td>

                                <td>₱<?php echo number_format($subtotal, 2); ?></td>

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

        <div class="text-end mt-4">
            <h3>Total: ₱<?php echo number_format($total, 2); ?></h3>
            <a href="checkout.php" class="btn btn-dark btn-lg mt-2">Proceed to Checkout</a>
        </div>

    <?php } else { ?>

        <div class="alert alert-info text-center">
            Your cart is empty.
        </div>

        <div class="text-center">
            <a href="shop.php" class="btn btn-dark">Continue Shopping</a>
        </div>

    <?php } ?>

</div>

<?php include 'includes/footer.php'; ?>
