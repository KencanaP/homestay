<!DOCTYPE html>
<html>
<head>
    <title>Guest Villa Page</title>
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

        .villa-container {
            background-color: #fffdf5cc;
            margin: 80px auto;
            padding: 30px;
            width: 90%;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            text-align: center;
        }

        .villa-container h2 {
            background-color: #d2b48c;
            padding: 10px 0;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .villa-grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 1px;
        }

        .villa-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            border: 2px solid black;
        }

        .villa-card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 1px;
        }

        .villa-card h3 {
            margin: 5px 0 1px;
            font-size: 18px;
        }

        .villa-card p {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
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

<div class="villa-container">
    <h2>YOUR BEST AESTHETIC VILLA</h2>
    <div class="villa-grid">

        <div class="villa-card">
            <img src="villaA.png" alt="Villa A">
            <h3>VILLA A</h3>
            <p>TYPE : ONE-STORY</p>
            <p>PRICE/NIGHT : RM 200</p>
            <p>POOL : NO</p>
        </div>

        <div class="villa-card">
            <img src="villaB.png" alt="Villa B">
            <h3>VILLA B</h3>
            <p>TYPE : TWO-STORY</p>
            <p>PRICE/NIGHT : RM 500</p>
            <p>POOL : YES</p>
        </div>

        <div class="villa-card">
            <img src="villaC.png" alt="Villa C">
            <h3>VILLA C</h3>
            <p>TYPE : MODERN</p>
            <p>PRICE/NIGHT : RM 1000</p>
            <p>POOL : YES</p>
        </div>

    </div>
</div>

</body>
</html>
