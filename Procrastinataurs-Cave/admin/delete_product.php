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

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    $query = mysqli_query($conn, "SELECT product_name, image FROM products WHERE product_id='$product_id'");

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        if (!empty($row['image'])) {
            $image_path = "../assets/images/bag_photos/" . $row['image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        recordAudit(
            $conn,
            "Admin",
            $_SESSION['admin_id'],
            "Deleted Product: " . $row['product_name'],
            "Product ID: " . $product_id . " | Image: " . $row['image']
        );
    }

    mysqli_query($conn, "DELETE FROM products WHERE product_id='$product_id'");
}

header("Location: products.php");
exit();
