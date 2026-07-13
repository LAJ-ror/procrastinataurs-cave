<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$message = "";

// Get categories
$category_query = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $category_id = sanitize($_POST['category_id']);
    $product_name = sanitize($_POST['product_name']);
    $description = sanitize($_POST['description']);
    $price = sanitize($_POST['price']);
    $stock = sanitize($_POST['stock']);

    $image = "";

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . "_" . basename($_FILES['image']['name']);
        $target_dir = "../assets/images/products/";
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = $image_name;
        }
    }

    $sql = "INSERT INTO products (category_id, product_name, description, price, stock, image)
            VALUES ('$category_id', '$product_name', '$description', '$price', '$stock', '$image')";

    if (mysqli_query($conn, $sql)) {
        header("Location: products.php");
        exit();
    } else {
        $message = "<div class='alert alert-danger'>Failed to add product.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">Procrastinataurs' Cave - Admin</a>
        <a href="products.php" class="btn btn-outline-light btn-sm">Back to Products</a>
    </div>
</nav>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Add Product</h4>
                </div>
                <div class="card-body">
                    <?php echo $message; ?>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                <?php while ($cat = mysqli_fetch_assoc($category_query)) { ?>
                                    <option value="<?php echo $cat['category_id']; ?>">
                                        <?php echo $cat['category_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" step="0.01" name="price" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-dark">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
