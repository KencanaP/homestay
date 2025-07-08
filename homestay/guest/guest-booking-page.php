<?php
include 'db_connect.php';

// Get Guest_ID from URL
if (!isset($_GET['Guest_ID'])) {
    die("Guest_ID is required.");
}
$guestID = $_GET['Guest_ID'];

// Get all bookings and prepare them for JavaScript
$sql = "SELECT Villa, CheckIn, CheckOut FROM Booking";
$result = $conn->query($sql);

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $start = new DateTime($row['CheckIn']);
    $end = new DateTime($row['CheckOut']);
    $villa = $row['Villa'];

    // Exclusive checkout date: we do NOT include checkout day
    while ($start < $end) {
        $bookings[$villa][] = $start->format('Y-m-d');
        $start->modify('+1 day');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guest Booking Page</title>
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

        .booking-container {
            background-color: #fffdf5cc;
            margin: 80px auto;
            padding: 30px;
            width: 90%;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            display: flex;
            justify-content: space-between;
        }

        .form-section {
            width: 50%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        select, input[type="date"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .villa-preview {
            width: 40%;
            text-align: center;
        }

        .villa-preview img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: contain;
            border: 2px solid black;
            border-radius: 10px;
        }

        .villa-preview h3 {
            margin-top: 15px;
            font-size: 20px;
            color: #333;
        }

        .booking-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #5d3923;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
    <script>
        const bookedDates = <?= json_encode($bookings) ?>;

        function updateVillaImage() {
            const villaSelect = document.getElementById('villa');
            const image = document.getElementById('villaImage');
            const title = document.getElementById('villaTitle');

            const villa = villaSelect.value;

            if (villa === 'A') {
                image.src = 'villaA.png';
                title.textContent = 'VILLA A - ONE';
            } else if (villa === 'B') {
                image.src = 'villaB.png';
                title.textContent = 'VILLA B - TWO-STORY';
            } else if (villa === 'C') {
                image.src = 'villaC.png';
                title.textContent = 'VILLA C - MODERN';
            } else {
                image.src = '';
                title.textContent = '';
            }

            updateDateDisabling();
        }

        function updateDateDisabling() {
            const villa = document.getElementById('villa').value;
            const checkinInput = document.getElementById('checkin');
            const checkoutInput = document.getElementById('checkout');

            checkinInput.addEventListener('change', validateDate);
            checkoutInput.addEventListener('change', validateDate);

            function validateDate(e) {
                const val = e.target.value;
                if (bookedDates[villa] && bookedDates[villa].includes(val)) {
                    alert("This date is already booked. Please choose another.");
                    e.target.value = '';
                }
            }
        }
    </script>
</head>
<body>

<div class="topbar">
    <div class="logo">
        <img src="logoSMV.png" alt="SMV Logo">
    </div>
    <div class="nav">
        <a href="guest-profile-page.php?Guest_ID=<?= urlencode($guestID) ?>">PROFILE</a>
        <a href="guest-update-page.php?Guest_ID=<?= urlencode($guestID) ?>">UPDATE</a>
        <a href="guest-villa-page.php?Guest_ID=<?= urlencode($guestID) ?>">VILLA</a>
        <a href="guest-booking-page.php?Guest_ID=<?= urlencode($guestID) ?>">NEW BOOKING</a>
        <a href="guest-history-page.php?Guest_ID=<?= urlencode($guestID) ?>">BOOKING HISTORY</a>
    </div>
</div>

<div class="booking-container">
    <form action="guest-booking-page2.php" method="GET" style="display: flex; width: 100%; justify-content: space-between;">
        <div class="form-section">
            <h2>Make a Booking</h2>
            <div class="form-group">
                <label for="villa">Select Villa</label>
                <select id="villa" name="villa" onchange="updateVillaImage()" required>
                    <option value="">-- Choose Villa --</option>
                    <option value="A">Villa A</option>
                    <option value="B">Villa B</option>
                    <option value="C">Villa C</option>
                </select>
            </div>

            <div class="form-group">
                <label for="checkin">Check-in Date</label>
                <input type="date" id="checkin" name="checkin" required>
            </div>

            <div class="form-group">
                <label for="checkout">Check-out Date</label>
                <input type="date" id="checkout" name="checkout" required>
            </div>

            <input type="hidden" name="Guest_ID" value="<?= htmlspecialchars($guestID) ?>">
        </div>

        <div class="villa-preview">
            <img id="villaImage" src="" alt="Villa Preview">
            <h3 id="villaTitle"></h3>

            <button type="submit" class="booking-button">BOOKING</button>
        </div>
    </form>
</div>

</body>
</html>
