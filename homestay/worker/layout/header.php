<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .profile-container {
            width: 1200px;
            margin: 30px auto;
            padding: 40px;
            background-color: rgb(178, 178, 178);
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-item {
            display: flex;
            margin-bottom: 18px;
            font-size: 18px;
        }

        .profile-label {
            width: 120px;
            font-weight: bold;
            color: #333;
        }

        .profile-value {
            flex: 1;
            color: #555;
        }

        .navbar-brand-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .navbar-brand {
            margin-bottom: 8px;
        }

        .brand-logo {
            max-height: 40px;
            width: auto;
        }
    </style>

</head>

<body background="assets/img/1.jpg" class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Sidebar Toggle Button (moved to left) -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-3" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar Brand with Logo -->
        <div class="navbar-brand-container ps-3">
            <a class="navbar-brand" href="worker-profile.php">SRI MENDAPAT VILLA</a>
            <img src="assets/img/logoSMV.png" alt="SMV Logo" class="brand-logo">
        </div>

        <!-- User Dropdown (moved to right) -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!--<li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>-->
                        <li><a class="dropdown-item" href="index.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="worker-profile.php">
                            <div class="sb-nav-link-icon"><i class='fab fa-fantasy-flight-games'></i></div>
                            Worker
                        </a>
                        <!--<a class="nav-link" href="stock-movement.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            About Us
                        </a>-->
                    </div>
                </div>
            </nav>
        </div>