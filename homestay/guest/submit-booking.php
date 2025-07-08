<?php
include 'db_connect.php';

$guest_id = $_GET['Guest_ID'] ?? '';
$villa = $_GET['villa'] ?? '';
$checkin = $_GET['checkin'] ?? '';
$checkout = $_GET['checkout'] ?? '';
$total = $_GET['total'] ?? '';
$payment = $_GET['payment'] ?? '';

// Calculate nights
$prices = ['A' => 200, 'B' => 500, 'C' => 1000];
$checkin_date = new DateTime($checkin);
$checkout_date = new DateTime($checkout);
$nights = $checkin_date->diff($checkout_date)->days;

$price_per_night = $prices[$villa] ?? 0;
$total_price = $nights * $price_per_night;

// Validate
if (!$guest_id || !$villa || !$checkin || !$checkout || !$payment || $nights <= 0) {
    die("Invalid data provided.");
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO Booking (Guest_ID, Villa, CheckIn, CheckOut, Nights, TotalPrice, PaymentMethod) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssids", $guest_id, $villa, $checkin, $checkout, $nights, $total_price, $payment);

if ($stmt->execute()) {
    header("Location: guest-history-page.php?Guest_ID=" . urlencode($guest_id));
    exit;
} else {
    echo "Booking failed: " . $conn->error;
}
?>
