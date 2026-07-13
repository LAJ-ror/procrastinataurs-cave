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

    // Get image filename
    $image_query = mysqli_query(
        $conn,
        "SELECT image FROM products WHERE product_id='$product_id'"
    );

    if ($image_query && mysqli_num_rows($image_query) > 0) {

        $image = mysqli_fetch_assoc($image_query);

        if (!empty($image['image'])) {

            $image_path = "../assets/images/products/" . $image['image'];

            if (file_exists($image_path)) {
                unlink($image_path);
            }

        }

    }

    // Delete product
    mysqli_query(
        $conn,
        "DELETE FROM products WHERE product_id='$product_id'"
    );

    // Audit Log
    recordAudit(
        $conn,
        "Admin",
        $_SESSION['admin_id'],
        "Deleted Product ID: " . $product_id
    );

}

header("Location: products.php");
exit();

?>
