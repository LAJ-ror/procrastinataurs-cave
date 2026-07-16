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

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$product_id = intval($_GET['id']);

$product_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$product_id'");
if (!$product_query || mysqli_num_rows($product_query) == 0) {
    header("Location: products.php");
    exit();
}

$product = mysqli_fetch_assoc($product_query);

$category_query = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $category_id = sanitize($_POST['category_id']);
    $product_name = sanitize($_POST['product_name']);
    $description = sanitize($_POST['description']);
    $price = sanitize($_POST['price']);
    $stock = sanitize($_POST['stock']);

    $new_image = $product['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $target_dir = "../assets/images/bag_photos/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $original_name = basename($_FILES['image']['name']);
        $file_ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $file_base = pathinfo($original_name, PATHINFO_FILENAME);
        $file_base = preg_replace('/[^A-Za-z0-9_-]/', '_', $file_base);

        $new_image = time() . "_" . $file_base . "." . $file_ext;
        $target_file = $target_dir . $new_image;

        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        if (!empty($product['image'])) {
            $old_image_path = "../assets/images/bag_photos/" . $product['image'];
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }
    }

    $update_sql = "UPDATE products SET
                    category_id='$category_id',
                    product_name='$product_name',
                    description='$description',
                    price='$price',
                    stock='$stock',
                    image='$new_image'
                   WHERE product_id='$product_id'";

    if (mysqli_query($conn, $update_sql)) {

        recordAudit(
            $conn,
            "Admin",
            $_SESSION['admin_id'],
            "Updated Product: " . $product_name,
            "Product ID: " . $product_id . " | Image: " . (!empty($new_image) ? $new_image : "None")
        );

        header("Location: products.php");
        exit();

    } else {
        $message = "<div class='alert alert-danger'>Failed to update product.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                    <h4 class="mb-0">Edit Product</h4>
                </div>
                <div class="card-body">
                    <?php echo $message; ?>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                <?php while ($cat = mysqli_fetch_assoc($category_query)) { ?>
                                    <option value="<?php echo $cat['category_id']; ?>"
                                        <?php if ($cat['category_id'] == $product['category_id']) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control"
                                   value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" step="0.01" name="price" class="form-control"
                                       value="<?php echo htmlspecialchars($product['price']); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control"
                                       value="<?php echo htmlspecialchars($product['stock']); ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Image</label><br>
                            <?php if (!empty($product['image'])) { ?>
                                <img src="../assets/images/bag_photos/<?php echo htmlspecialchars($product['image']); ?>"
                                     width="120"
                                     class="rounded mb-3">
                            <?php } else { ?>
                                <p class="text-muted">No image uploaded.</p>
                            <?php } ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Change Image</label>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted">Saved to assets/images/bag_photos/</small>
                        </div>

                        <button type="submit" class="btn btn-dark">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
