<?php
/* =====================================
   Database Configuration
   Procastinataurs Cave
   :) final proj
===================================== */

$host = "localhost";
$username = "root";
$password = "";
$database = "procrastinataurs_cave";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die ("Database Connection Failed:" . mysqli_connect_error());
}

?>