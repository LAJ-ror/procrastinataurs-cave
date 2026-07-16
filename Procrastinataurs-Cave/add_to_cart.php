<?php
require_once 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = (int) $_SESSION['user_id'];
    $product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

    if ($product_id <= 0 || $quantity <= 0) {
        header("Location: shop.php");
        exit();
    }

    // Make sure product exists
    $product_check = mysqli_query($conn, "SELECT product_id FROM products WHERE product_id='$product_id' LIMIT 1");

    if (!$product_check || mysqli_num_rows($product_check) == 0) {
        header("Location: shop.php");
        exit();
    }

    // Check if item already exists in cart
    $cart_check = mysqli_query(
        $conn,
        "SELECT cart_id, quantity FROM cart WHERE user_id='$user_id' AND product_id='$product_id' LIMIT 1"
    );

    if ($cart_check && mysqli_num_rows($cart_check) > 0) {
        $row = mysqli_fetch_assoc($cart_check);
        $new_quantity = (int) $row['quantity'] + $quantity;

        mysqli_query(
            $conn,
            "UPDATE cart SET quantity='$new_quantity' WHERE cart_id='{$row['cart_id']}'"
        );
    } else {
        mysqli_query(
            $conn,
            "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')"
        );
    }
}

header("Location: cart.php");
exit();
