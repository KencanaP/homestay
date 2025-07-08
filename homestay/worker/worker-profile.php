<?php include('layout/header.php'); ?>
<?php
$host = 'localhost';
$db   = 'homestay';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$staffID = 'S001'; // or hardcode temporarily for testing

$sql = "SELECT * FROM Staff WHERE Staff_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $staffID);
$stmt->execute();
$result = $stmt->get_result();
$staff = $result->fetch_assoc();
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Worker Profile </h1>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex align-items-center">
                            <a href="worker-profile.php" class="btn btn-light">Profile</a>
                            <a href="worker-schedule.php" class="btn btn-light">Worker Schedule</a>
                            <a href="worker-leave.php" class="btn btn-light">Leave Application</a>
                        </div>
                        <div class="profile-container">
                            <div class="profile-item">
                                <div class="profile-label">NAME:</div>
                                <div class="profile-value"><?= htmlspecialchars($staff['Staff_Name']) ?></div>
                            </div>
                            <div class="profile-item">
                                <div class="profile-label">ID:</div>
                                <div class="profile-value"><?= htmlspecialchars($staff['Staff_ID']) ?></div>
                            </div>
                            <div class="profile-item">
                                <div class="profile-label">EMAIL:</div>
                                <div class="profile-value"><?= htmlspecialchars($staff['Staff_PhoneNo']) ?></div>
                            </div>
                            <div class="profile-item">
                                <div class="profile-label">AGE:</div>
                                <div class="profile-value">25</div> <!-- Replace if you have age -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <a href="edit-profile-worker.php" class="btn btn-success text-white">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $conn->close(); ?>
    <?php include('layout/footer.php'); ?>