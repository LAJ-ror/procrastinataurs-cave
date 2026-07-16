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
    $cart_id = isset($_POST['cart_id']) ? (int) $_POST['cart_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

    if ($cart_id > 0 && $quantity > 0) {
        mysqli_query(
            $conn,
            "UPDATE cart SET quantity='$quantity' WHERE cart_id='$cart_id' AND user_id='$user_id'"
        );
    }
}

header("Location: cart.php");
exit();
