<?php

function sanitize($data)
{
    return htmlspecialchars(trim($data));
}

function redirect($page)
{
    header("Location: $page");
    exit();
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function recordAudit($conn, $userType, $userId, $activity)
{
    $activity = mysqli_real_escape_string($conn, $activity);

    mysqli_query(
        $conn,
        "INSERT INTO audit_logs(user_type, user_id, activity)
         VALUES('$userType','$userId','$activity')"
    );
}

?>