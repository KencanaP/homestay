<?php
// No session needed if we're accessing via URL only
include 'db_connect.php';

// Check if Guest_ID is provided via URL
if (!isset($_GET['Guest_ID'])) {
    die("Error: Guest_ID not provided in URL.");
}

$guest_id = $_GET['Guest_ID'];

// Prepare and execute query
$sql = "SELECT Guest_Name, Guest_ID, Guest_PhoneNo, Guest_Email, Guest_Age FROM Guest WHERE Guest_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $guest_id);
$stmt->execute();
$result = $stmt->get_result();
$guest = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Guest Profile</title>
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
            height: 80px; /* Make navbar tall enough for logo */
        }

        .topbar .nav a {
            color: #fff3e6;
            text-decoration: none;
            margin: 0 10px;
            padding: 6px 12px;
            border: 1px solid #d2b48c;
            border-radius: 20px;
        }

        .profile-container {
            background-color: #fffdf5cc;
            margin: 80px auto;
            padding: 30px;
            width: 60%;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
        }

        .profile-container h2 {
            background-color: #d2b48c;
            padding: 10px 0;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .profile-field {
            margin: 20px 0;
            font-size: 1.1em;
        }

        .profile-field label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        .profile-field span {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            width: 300px;
            border: 1px solid #ccc;
        }

        .footer-image {
            position: fixed;
            bottom: 10px;
            right: 10px;
            width: 120px;
        }

        .logo img {
            height: 180px; /* Increase this as needed */
            width: auto;  /* Keep original image proportions */
            display: block;
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


<div class="profile-container">
    <h2>Your Profile</h2>

    <?php if ($guest): ?>
        <div class="profile-field">
            <label>Guest Name:</label>
            <span><?= htmlspecialchars($guest['Guest_Name']) ?></span>
        </div>
        <div class="profile-field">
            <label>Guest ID:</label>
            <span><?= htmlspecialchars($guest['Guest_ID']) ?></span>
        </div>
        <div class="profile-field">
            <label>Mobile Phone:</label>
            <span><?= htmlspecialchars($guest['Guest_PhoneNo']) ?></span>
        </div>
        <div class="profile-field">
            <label>Email:</label>
            <span><?= htmlspecialchars($guest['Guest_Email']) ?></span>
        </div>
        <div class="profile-field">
            <label>Age:</label>
            <span><?= htmlspecialchars($guest['Guest_Age']) ?></span>
        </div>

    <?php else: ?>
        <p style="text-align:center; color:red;">Guest not found.</p>
    <?php endif; ?>
</div>

<!-- Optional decorative image -->
<!-- <img src="your-house-icon.png" alt="House Icon" class="footer-image"> -->

</body>
</html>
