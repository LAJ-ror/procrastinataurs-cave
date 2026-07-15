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

$sql = "SELECT p.product_id, p.product_name, p.price, p.stock, p.image, c.category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.category_id
        ORDER BY p.product_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">Procrastinataurs' Cave - Admin</a>
        <div class="ms-auto">
            <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
            <a href="add_product.php" class="btn btn-warning btn-sm me-2">Add Product</a>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manage Products</h2>
        <a href="add_product.php" class="btn btn-dark">+ Add Product</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['product_id']; ?></td>
                                <td>
                                    <img src="../assets/images/products/<?php echo $row['image']; ?>"
                                         alt="Product"
                                         width="70"
                                         class="rounded">
                                </td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td>₱<?php echo number_format($row['price'], 2); ?></td>
                                <td><?php echo $row['stock']; ?></td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $row['product_id']; ?>"
                                     class="btn btn-primary btn-sm me-1">Edit</a>

                                    <a href="delete_product.php?id=<?php echo $row['product_id']; ?>"
                                 class="btn btn-danger btn-sm"
                             onclick="return confirm('Are you sure you want to delete this product?');">
                          Delete
                     </a>
                 </td>
             </tr>
         <?php }
?>
                    
   <?php } 
else { 
?>
 <tr>  
     <td colspan="7" class="text-center">No products found.</td>
         </tr>
            <?php } ?>
             </tbody>
        </table>
     </div>
 </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
