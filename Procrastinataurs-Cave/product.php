<?php
require_once 'includes/db.php';
include 'includes/header.php';

$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

if ($product_id <= 0) {
    echo '<div class="container my-5"><div class="alert alert-warning">Product not found.</div></div>';
    include 'includes/footer.php';
    exit;
}

$sql = "SELECT product_name, description, price, image FROM products WHERE product_id = $product_id LIMIT 1";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo '<div class="container my-5"><div class="alert alert-warning">Product not found.</div></div>';
    include 'includes/footer.php';
    exit;
}

$product = mysqli_fetch_assoc($result);
$imagePath = !empty($product['image']) ? "assets/images/products/" . $product['image'] : "assets/images/product_bags/handbag.avif";
?>

<div class="container my-5">

    <div class="row">

        <!-- Product Image -->
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($imagePath); ?>"
                 class="img-fluid rounded shadow"
                 alt="<?php echo htmlspecialchars($product['product_name']); ?>">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <h4 class="text-success mb-3">₱<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></h4>
            <p><?php echo nl2br(htmlspecialchars($product['description'] ?: 'No description available.')); ?></p>
            <hr>
            <h5>Product Features</h5>
            <ul>
                <li>Premium Quality Material</li>
                <li>Water Resistant</li>
                <li>Large Storage Capacity</li>
                <li>Comfortable Shoulder Straps</li>
            </ul>
            <div class="mt-4">
                <button class="btn btn-dark btn-lg">Add to Cart</button>
            </div>
        </div>

    </div>

</div>

<?php
include 'includes/footer.php';
?>