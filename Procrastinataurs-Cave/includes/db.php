<?php
/* =====================================
   Database Configuration
   Procastinataurs Cave
   :) final proj
===================================== */

$host = "sql212.infinityfree.com";
$username = "if0_42425269";
$password = "saveusfrth1sh3L";
$database = "if0_42425269_procrastinataurs";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die ("Database Connection Failed:" . mysqli_connect_error());
}

?>