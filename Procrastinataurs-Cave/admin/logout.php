<?php

require_once '../includes/db.php';
require_once '../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Record admin logout in audit logs
if (isset($_SESSION['admin_id'])) {

    recordAudit(
        $conn,
        "Admin",
        $_SESSION['admin_id'],
        "Admin Logged Out"
    );

}

// Destroy admin session
session_destroy();

// Redirect to admin login page
header("Location: login.php");
exit();

?>
