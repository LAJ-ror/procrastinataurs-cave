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
    $userType = mysqli_real_escape_string($conn, $userType);
    $activity = mysqli_real_escape_string($conn, $activity);

    $sql = "INSERT INTO audit_logs
            (user_type, user_id, activity)
            VALUES
            ('$userType', '$userId', '$activity')";

    mysqli_query($conn, $sql);
}