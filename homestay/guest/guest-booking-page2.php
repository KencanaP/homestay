<?php
$guest_id = $_GET['Guest_ID'];
$villa = $_GET['villa'];
$checkin = $_GET['checkin'];
$checkout = $_GET['checkout'];

$prices = [
    'A' => 200,
    'B' => 500,
    'C' => 1000
];

$villa_names = [
    'A' => 'VILLA A - ONE-STORY',
    'B' => 'VILLA B - TWO-STORY',
    'C' => 'VILLA C - MODERN'
];

$price_per_night = $prices[$villa] ?? 0;

$checkin_date = new DateTime($checkin);
$checkout_date = new DateTime($checkout);
$interval = $checkin_date->diff($checkout_date);
$nights = $interval->days;

$total_payment = $nights * $price_per_night;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
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

        .nav a {
            color: #fff3e6;
            text-decoration: none;
            margin: 0 10px;
            padding: 6px 12px;
            border: 1px solid #d2b48c;
            border-radius: 20px;
        }

        .summary-container {
            background-color: #fffdf5cc;
            margin: 80px auto;
            padding: 30px;
            width: 60%;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .summary-container h2 {
            background-color: #d2b48c;
            padding: 10px 0;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .summary-field {
            margin: 15px 0;
            font-size: 1.1em;
        }

        .summary-field label {
            display: inline-block;
            width: 160px;
            font-weight: bold;
        }

        select {
            padding: 10px;
            width: 50%;
            border-radius: 5px;
        }

        .btn-confirm {
            margin-top: 30px;
            padding: 10px 25px;
            background-color: #5d3923;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
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

<div class="summary-container">
    <h2>Payment</h2>

    <div class="summary-field">
        <label>Villa:</label> <?= $villa_names[$villa] ?>
    </div>
    <div class="summary-field">
        <label>Check-in:</label> <?= htmlspecialchars($checkin) ?>
    </div>
    <div class="summary-field">
        <label>Check-out:</label> <?= htmlspecialchars($checkout) ?>
    </div>
    <div class="summary-field">
        <label>Nights:</label> <?= $nights ?> night(s)
    </div>
    <div class="summary-field">
        <label>Total Price:</label> RM <?= $total_payment ?>
    </div>

    <form id="bookingForm" method="GET">
    <input type="hidden" name="Guest_ID" value="<?= htmlspecialchars($guest_id) ?>">
    <input type="hidden" name="villa" value="<?= htmlspecialchars($villa) ?>">
    <input type="hidden" name="checkin" value="<?= htmlspecialchars($checkin) ?>">
    <input type="hidden" name="checkout" value="<?= htmlspecialchars($checkout) ?>">
    <input type="hidden" name="total" value="<?= $total_payment ?>">

    <div class="summary-field">
        <label>Payment Method:</label>
        <select name="payment_method" required>
            <option value="">-- Select Payment --</option>
            <option value="Online Banking">Online Banking</option>
            <option value="Debit Card">Debit Card</option>
        </select>
    </div>

    <button type="submit" class="btn-confirm">Proceed to payment</button>
</form>
</div>

<script>
document.getElementById("bookingForm").addEventListener("submit", function(e) {
    const form = this;
    const method = form.payment_method.value;
    const guestID = form.Guest_ID.value;
    const villa = form.villa.value;
    const checkin = form.checkin.value;
    const checkout = form.checkout.value;
    const total = form.total.value;

    if (method === "Online Banking") {
        form.action = `guest-bank-page.php?Guest_ID=${encodeURIComponent(guestID)}&villa=${villa}&checkin=${checkin}&checkout=${checkout}&total=${total}`;
    } else if (method === "Debit Card") {
        form.action = `guest-card-page.php?Guest_ID=${encodeURIComponent(guestID)}&villa=${villa}&checkin=${checkin}&checkout=${checkout}&total=${total}`;
    } else {
        e.preventDefault();
        alert("Please select a valid payment method.");
    }
});
</script>


</body>
</html>
