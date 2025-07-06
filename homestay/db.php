<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "homestay";

// Create connection
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: Set character set
mysqli_set_charset($con, "utf8");
