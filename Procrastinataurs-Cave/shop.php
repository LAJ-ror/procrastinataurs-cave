<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

include 'includes/header.php';

$selected_category = isset($_GET['category']) ? trim($_GET['category']) : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT p.*, c.category_name
        FROM products p
        INNER JOIN categories c ON p.category_id = c.category_id
        WHERE 1=1";

if (!empty($selected_category)) {
    $selected_category = mysqli_real_escape_string($conn, $selected_category);
    $sql .= " AND c.category_name = '$selected_category'";
}

if (!empty($search)) {
    $search = mysqli_real_escape_string($conn, $search);
    $sql .= " AND (p.product_name LIKE '%$search%' OR p.description LIKE '%$search%')";
}

$sql .= " ORDER BY p.product_id DESC";

$result = mysqli_query($conn, $sql);
?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Shop</h1>
        <p class="text-muted">Browse our latest bag collection.</p>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form method="GET" action="shop.php">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search bags..."
                           value="<?php echo htmlspecialchars($search); ?>">

                    <?php if (!empty($selected_category)) { ?>
                        <input type="hidden" name="category" value="<?php echo htmlspecialchars($selected_category); ?>">
                    <?php } ?>

                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center mb-5">
        <a href="shop.php" class="btn <?php echo empty($selected_category) ? 'btn-dark' : 'btn-outline-dark'; ?> m-1">All</a>
        <a href="shop.php?category=Handbags" class="btn <?php echo $selected_category == 'Handbags' ? 'btn-dark' : 'btn-outline-dark'; ?> m-1">Handbags</a>
        <a href="shop.php?category=Travel%20Bags" class="btn <?php echo $selected_category == 'Travel Bags' ? 'btn-dark' : 'btn-outline-dark'; ?> m-1">Travel Bags</a>
        <a href="shop.php?category=Tote%20Bags" class="btn <?php echo $selected_category == 'Tote Bags' ? 'btn-dark' : 'btn-outline-dark'; ?> m-1">Tote Bags</a>
        <a href="shop.php?category=Wallets" class="btn <?php echo $selected_category == 'Wallets' ? 'btn-dark' : 'btn-outline-dark'; ?> m-1">Wallets</a>
    </div>

    <div class="row">
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($row['image'])) { ?>
                            <img src="assets/images/bag_photos/<?php echo htmlspecialchars($row['image']); ?>"
                                 class="card-img-top"
                                 alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                        <?php } else { ?>
                            <div class="bg-light text-center p-5">
                                No Image
                            </div>
                        <?php } ?>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                            <p class="text-muted mb-1"><?php echo htmlspecialchars($row['category_name']); ?></p>
                            <p class="text-muted mb-2">₱<?php echo number_format($row['price'], 2); ?></p>
                            <p class="small"><?php echo htmlspecialchars($row['description']); ?></p>
                        </div>

                       <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <input type="hidden" name="quantity" value="1">
                        
                            <button type="submit" class="btn btn-dark w-100">
                                Add to Cart
                            </button>
                                </form>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No products found for this category or search term.
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
