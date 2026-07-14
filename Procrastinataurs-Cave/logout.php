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
if (isset($_SESSION['user_id'])) {
    recordAudit($conn, "Buyer", $_SESSION['user_id'], "User Logged Out");
}
setcookie('remember_email', '', time() - 3600, '/');


// Destroy session
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();

?>