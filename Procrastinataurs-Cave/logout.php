<?php

require_once 'includes/db.php';
require_once 'includes/functions.php';

recordAudit(
    $conn,
    "Buyer",
    $_SESSION['user_id'],
    "User Logged Out"
);

session_start();

session_destroy();

header("Location: login.php");

exit();

?>