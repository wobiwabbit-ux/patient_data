<?php
// db.php - database connection

$host = 'localhost';
$user = 'root';
$pass = '';          // default password sa XAMPP is empty
$db   = 'patient_data';  // <-- ito ang name ng database mo sa phpMyAdmin

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// optional for debugging:
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
