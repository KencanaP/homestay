<?php
include 'db_connect.php'; // <-- This must come before using $conn

$guest_id = $_GET['Guest_ID'];

$sql = "SELECT * FROM Booking WHERE Guest_ID = ?";
$stmt = $conn->prepare($sql);  // This will now work if $conn is properly defined
$stmt->bind_param("s", $guest_id);
$stmt->execute();
$result = $stmt->get_result();



$villa_names = [
    'A' => 'VILLA A - ONE-STORY',
    'B' => 'VILLA B - TWO-STORY',
    'C' => 'VILLA C - MODERN'
];

$conn = new mysqli("localhost", "root", "", "homestay_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$stmt = $conn->prepare("SELECT Villa, CheckIn, CheckOut, Nights, TotalPrice, PaymentMethod FROM Booking WHERE Guest_ID = ? ORDER BY BookingDate DESC");
$stmt->bind_param("s", $guest_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking History</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('homepage.png') no-repeat center center fixed;
            background-size: cover;
        }

        .topbar {
            background-color: #5d3923;
            padding: 10px 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }

        .logo img {
            height: 180px;
            width: auto;
            display: block;
        }

        .nav {
            display: flex;
            gap: 10px;
        }

        .nav a {
            color: #fff3e6;
            text-decoration: none;
            margin: 0 10px;
            padding: 6px 12px;
            border: 1px solid #d2b48c;
            border-radius: 20px;
        }

        .history-container {
            background-color: #fffdf5cc;
            margin: 80px auto;
            padding: 30px;
            width: 90%;
            border-radius: 15px;
        }

        .header-title {
            background-color: #b9a180;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 12px 20px;
            width: 300px;
            margin: 0 auto 30px;
            border-radius: 20px;
            box-shadow: 0 4px 5px rgba(0,0,0,0.2);
        }

        .booking-card {
            background-color: white;
            margin-bottom: 20px;
            border-radius: 10px;
            padding: 20px;
            border: 2px solid black;
            display: flex;
            flex-direction: column;
            font-size: 16px;
        }

        .booking-card div {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .label {
            font-weight: bold;
            color: #330033;
        }

        .value {
            color: #333;
        }
    </style>
</head>
<body>

<div class="topbar">
    <div class="logo">
        <img src="logoSMV.png" alt="SMV Logo">
    </div>
    <div class="nav">
        <a href="guest-profile-page.php?Guest_ID=<?= urlencode($_GET['Guest_ID']) ?>">PROFILE</a>
        <a href="guest-update-page.php?Guest_ID=<?= urlencode($_GET['Guest_ID']) ?>">UPDATE</a>
        <a href="guest-villa-page.php?Guest_ID=<?= urlencode($_GET['Guest_ID']) ?>">VILLA</a>
        <a href="guest-booking-page.php?Guest_ID=<?= urlencode($_GET['Guest_ID']) ?>">NEW BOOKING</a>
        <a href="guest-history-page.php?Guest_ID=<?= urlencode($_GET['Guest_ID']) ?>">BOOKING HISTORY</a>
    </div>
</div>

<div class="history-container">
    <div class="header-title">YOUR BOOKING HISTORY</div>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="booking-card">
            <div><span class="label"><?= $villa_names[$row['Villa']] ?></span></div>
            <div><span class="label">NIGHTS :</span> <span class="value"><?= $row['Nights'] ?> Night(s)</span></div>
            <div><span class="label">CHECK-IN DATE :</span> <span class="value"><?= $row['CheckIn'] ?></span></div>
            <div><span class="label">CHECK-OUT DATE :</span> <span class="value"><?= $row['CheckOut'] ?></span></div>
            <div><span class="label">TOTAL PRICE :</span> <span class="value">RM <?= number_format($row['TotalPrice'], 2) ?></span></div>
            <div><span class="label">PAYMENT METHOD :</span> <span class="value"><?= htmlspecialchars($row['PaymentMethod']) ?></span></div>
        </div>

    <?php endwhile; ?>

    <?php
    $stmt->close();
    $conn->close();
    ?>
</div>

</body>
</html>
