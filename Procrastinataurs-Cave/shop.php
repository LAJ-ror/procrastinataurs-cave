<?php
$currentPage = "shop";

require_once 'includes/db.php';
include 'includes/header.php';
?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Shop</h1>
        <p class="text-muted">Browse our latest bag collection.</p>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search bags...">
                    <button class="btn btn-dark" type="submit">
                        <i class="bi bi-search"></i>
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center mb-5">
        <button class="btn btn-outline-dark m-1">All</button>
        <button class="btn btn-outline-dark m-1">Handbags</button>
        <button class="btn btn-outline-dark m-1">Backpacks</button>
        <button class="btn btn-outline-dark m-1">Travel Bags</button>
        <button class="btn btn-outline-dark m-1">Luggage</button>
    </div>

    <div class="container">
        <div class="row">
            <?php
            $sql = "SELECT product_id, product_name, description, price, image FROM products ORDER BY product_name ASC";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($product = mysqli_fetch_assoc($result)) {
                    $imagePath = !empty($product['image']) ? "assets/images/products/" . $product['image'] : "assets/images/product_bags/luggage.jpg";
                    $price = number_format($product['price'], 2);
                    $description = !empty($product['description']) ? $product['description'] : 'No description available.';
            ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                <p class="text-muted mb-2">₱<?php echo htmlspecialchars($price); ?></p>
                                <p class="small"><?php echo htmlspecialchars($description); ?></p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="product.php?product_id=<?php echo (int)$product['product_id']; ?>" class="btn btn-outline-dark w-100 mb-2">View Details</a>
                                <button class="btn btn-dark w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
            ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">No products are available at the moment.</div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

</div>

<?php
include 'includes/footer.php';
?>