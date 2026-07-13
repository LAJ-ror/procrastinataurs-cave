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
    $admin_id = intval($_GET['id']);

    // Prevent deleting your own account
    if ($admin_id != $_SESSION['admin_id']) {
        mysqli_query($conn, "DELETE FROM admins WHERE admin_id='$admin_id'");
    }
}

header("Location: users.php");
exit();
