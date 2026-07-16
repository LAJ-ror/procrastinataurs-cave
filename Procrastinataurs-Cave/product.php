<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

include 'includes/header.php';

if (!isset($_GET['id'])) {
    echo "<div class='container my-5'><div class='alert alert-danger'>Product not found.</div></div>";
    include 'includes/footer.php';
    exit();
}

$product_id = intval($_GET['id']);

$sql = "SELECT p.*, c.category_name
        FROM products p
        INNER JOIN categories c ON p.category_id = c.category_id
        WHERE p.product_id = '$product_id'";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='container my-5'><div class='alert alert-danger'>Product not found.</div></div>";
    include 'includes/footer.php';
    exit();
}

$product = mysqli_fetch_assoc($result);
?>

<div class="container my-5">

    <div class="row">

        <div class="col-md-6 mb-4">
            <?php if (!empty($product['image'])) { ?>
                <img src="assets/images/bag_photos/<?php echo htmlspecialchars($product['image']); ?>"
                     class="img-fluid rounded shadow"
                     alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            <?php } else { ?>
                <div class="bg-light text-center p-5 rounded shadow">
                    No Image Available
                </div>
            <?php } ?>
        </div>

        <div class="col-md-6">

            <h2 class="fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h2>

            <p class="text-muted mb-2"><?php echo htmlspecialchars($product['category_name']); ?></p>

            <h4 class="text-success mb-3">
                ₱<?php echo number_format($product['price'], 2); ?>
            </h4>

            <p><?php echo htmlspecialchars($product['description']); ?></p>

            <p><strong>Available Stock:</strong> <?php echo $product['stock']; ?></p>

            <hr>

            <h5>Product Features</h5>
            <ul>
                <li>Premium Quality Material</li>
                <li>Durable and Stylish</li>
                <li>Perfect for Everyday Use</li>
            </ul>

            <div class="mt-4">
                <button class="btn btn-dark btn-lg">
                    Add to Cart
                </button>
            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
