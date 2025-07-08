<?php
// Extract booking data from URL
$guest_id = $_GET['Guest_ID'] ?? '';
$villa = $_GET['villa'] ?? '';
$checkin = $_GET['checkin'] ?? '';
$checkout = $_GET['checkout'] ?? '';
$total = $_GET['total'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Banking Payment</title>
    <style>
        body {
            margin: 0;
            background: #5d3923;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .bank-container img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
        }

        .btn-finish {
            margin-top: 20px;
            padding: 12px 25px;
            background-color: white;
            color: #5d3923;
            border: none;
            font-weight: bold;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
        }

        .btn-finish:hover {
            background-color: #d2b48c;
        }
    </style>
</head>
<body>
    <div class="bank-container">
        <img src="onlinebank.png" alt="Online Banking Payment Page">
        <form action="submit-booking.php" method="GET">
            <input type="hidden" name="Guest_ID" value="<?= htmlspecialchars($guest_id) ?>">
            <input type="hidden" name="villa" value="<?= htmlspecialchars($villa) ?>">
            <input type="hidden" name="checkin" value="<?= htmlspecialchars($checkin) ?>">
            <input type="hidden" name="checkout" value="<?= htmlspecialchars($checkout) ?>">
            <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
            <input type="hidden" name="payment" value="Online Banking">
            <button type="submit" class="btn-finish">FINISH PAYMENT</button>
        </form>
    </div>
</body>
</html>
