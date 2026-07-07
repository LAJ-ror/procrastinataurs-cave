<?php

session_start();

require_once 'includes/db.php';
require_once 'includes/functions.php';

// Record logout activity
if (isset($_SESSION['user_id'])) {

    recordAudit(
        $conn,
        "Buyer",
        $_SESSION['user_id'],
        "User Logged Out"
    );

}

// Destroy session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();

?>