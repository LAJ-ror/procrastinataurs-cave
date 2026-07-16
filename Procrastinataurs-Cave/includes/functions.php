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

function recordAudit($conn, $userType, $userId, $activity, $details = null)
{
    $userType = mysqli_real_escape_string($conn, $userType);
    $activity = mysqli_real_escape_string($conn, $activity);
    $details = $details !== null ? mysqli_real_escape_string($conn, $details) : null;

    $details_sql = is_null($details) || $details === '' ? "NULL" : "'" . $details . "'";

    $sql = "INSERT INTO audit_logs (user_type, user_id, activity, details)
            VALUES ('$userType', '$userId', '$activity', $details_sql)";

    mysqli_query($conn, $sql);
}
?>
