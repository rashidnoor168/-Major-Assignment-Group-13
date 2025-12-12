<?php
$server = "localhost";
$username = "root";
$password = "";
$databasename = "pms_db";

// Connect to the database directly
$conn = mysqli_connect($server, $username, $password, $databasename);

// Check if connection failed
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set to utf8mb4 (handles special characters/emojis correctly)
mysqli_set_charset($conn, "utf8mb4");
?>
