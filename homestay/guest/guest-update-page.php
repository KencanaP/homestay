<?php
include 'db_connect.php';

if (!isset($_GET['Guest_ID'])) {
    die("Error: Guest_ID not provided in URL.");
}

$guest_id = $_GET['Guest_ID'];

// Fetch existing data
$sql = "SELECT Guest_Name, Guest_PhoneNo, Guest_Email FROM Guest WHERE Guest_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $guest_id);
$stmt->execute();
$result = $stmt->get_result();
$guest = $result->fetch_assoc();

if (!$guest) {
    die("Guest not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST['Guest_Name'];
    $new_phone = $_POST['Guest_PhoneNo'];
    $new_email = $_POST['Guest_Email'];

    $update_sql = "UPDATE Guest SET Guest_Name = ?, Guest_PhoneNo = ?, Guest_Email = ? WHERE Guest_ID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssss", $new_name, $new_phone, $new_email, $guest_id);

    if ($update_stmt->execute()) {
        header("Location: guest-profile-page.php?Guest_ID=" . urlencode($guest_id));
        exit();
    } else {
        echo "Update failed.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Guest Profile</title>
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

        .topbar .nav a {
            color: #fff3e6;
            text-decoration: none;
            margin: 0 10px;
            padding: 6px 12px;
            border: 1px solid #d2b48c;
            border-radius: 20px;
        }

        .logo img {
            height: 180px;
            width: auto;
            display: block;
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

        .form-group {
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 300px;
        }

        button {
            margin-top: 10px;
            background-color: #5d3923;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
        }

        button:hover {
            background-color: #40291a;
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
    <h2>Update Your Profile</h2>
    <form method="POST">
        <div class="form-group">
            <label for="Guest_Name">Guest Name:</label>
            <input type="text" id="Guest_Name" name="Guest_Name" value="<?= htmlspecialchars($guest['Guest_Name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Guest_PhoneNo">Mobile Phone:</label>
            <input type="text" id="Guest_PhoneNo" name="Guest_PhoneNo" value="<?= htmlspecialchars($guest['Guest_PhoneNo']) ?>" required>
        </div>
        <div class="form-group">
            <label for="Guest_Email">Email:</label>
            <input type="email" id="Guest_Email" name="Guest_Email" value="<?= htmlspecialchars($guest['Guest_Email']) ?>">
        </div>
        <button type="submit">Save Changes</button>
    </form>
</div>

</body>
</html>
