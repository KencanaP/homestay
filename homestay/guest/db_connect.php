<?php
$host = 'localhost';
$user = 'root'; // Change this if your DB username is different
$password = ''; // Change this to your DB password
$database = 'homestay_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
