<?php include('layout/header.php'); ?>

<?php
// Database connection
$host = 'localhost';
$db   = 'homestay';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in staff ID (you can modify this based on your session management)
$staffID = 'S001'; // Replace with session variable: $_SESSION['staff_id']

// Get all maintenance tasks for this staff member from the three tables
$sql = "SELECT 
    m.Maintenance_ID,
    m.Maintenance_Date,
    mt.MaintenanceType_Name,
    h.House_ID
FROM maintenance m
JOIN maintenancetype mt ON m.MaintenanceType_ID = mt.MaintenanceType_ID
JOIN house h ON m.House_ID = h.House_ID
WHERE m.Staff_ID = ?
ORDER BY m.Maintenance_Date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $staffID);
$stmt->execute();
$result = $stmt->get_result();
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Worker Schedule</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <a href="worker-profile.php" class="btn btn-light me-2">Profile</a>
                            <a href="worker-schedule.php" class="btn btn-light">Worker Schedule</a>
                            <a href="worker-leave.php" class="btn btn-light">Leave Application</a>
                        </div>
                        <div class="card-body">
                            <?php if ($result->num_rows > 0): ?>
                                <table id="datatablesSimple" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>House ID</th>
                                            <th>Task</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['Maintenance_ID']) ?></td>
                                                <td><?= htmlspecialchars($row['House_ID']) ?></td>
                                                <td><?= htmlspecialchars($row['MaintenanceType_Name']) ?></td>
                                                <td><?= date('Y-m-d', strtotime($row['Maintenance_Date'])) ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <h4><i class="fas fa-info-circle"></i> No tasks assigned</h4>
                                    <p>You currently have no maintenance tasks assigned to you.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('layout/footer.php'); ?>
</div>

<?php
$conn->close();
?>