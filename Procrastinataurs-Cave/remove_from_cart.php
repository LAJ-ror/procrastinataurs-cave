<?php
require_once 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['cart_id'])) {

    $user_id = (int) $_SESSION['user_id'];
    $cart_id = (int) $_GET['cart_id'];

    mysqli_query(
        $conn,
        "DELETE FROM cart WHERE cart_id='$cart_id' AND user_id='$user_id'"
    );
}

header("Location: cart.php");
exit();
