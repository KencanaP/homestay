<?php 
session_start();
include('layout/header.php'); 
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Worker Leave Application</h1>
            
            <!-- Display success/error messages -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center">
                            <a href="worker-profile.php" class="btn btn-light me-2">Profile</a>
                            <a href="worker-schedule.php" class="btn btn-light me-2">Worker Schedule</a>
                            <a href="worker-leave.php" class="btn btn-light">Leave Application</a>
                        </div>
                        <div class="container-fluid px-4">
                            <form action="submit-worker-leave.php" method="POST" enctype="multipart/form-data" class="mt-4">
                                <div class="form-group mt-2">
                                    <label for="item_name">Leave Category <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter absent type (e.g., Sick Leave, Personal Leave)" required>
                                </div>
                                
                                <div class="form-group mt-2">
                                    <label for="item_desc">Reason For Leave <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="item_desc" id="item_desc" rows="4" placeholder="Enter detailed reason for leave" required></textarea>
                                    <small class="form-text text-muted">Please attach medical certificate (MC) if applicable</small>
                                </div>
                                
                                <div class="form-group mt-2">
                                    <label for="img">Attachment (MC or Supporting Document)</label>
                                    <input type="file" class="form-control" id="img" name="img" accept="image/*,.pdf">
                                    <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF, PDF (Max 5MB)</small>
                                </div>
                                
                                <div class="form-group mt-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="startDate">Start Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="startDate" name="startDate" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="endDate">End Date</label>
                                            <input type="date" class="form-control" id="endDate" name="endDate">
                                            <small class="form-text text-muted">Leave blank if single day leave</small>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">
                                    <i class="fas fa-paper-plane"></i> Submit Leave Application
                                </button>
                                <a href="worker-schedule.php" class="btn btn-secondary mt-4 ms-2">
                                    <i class="fas fa-arrow-left"></i> Back to Schedule
                                </a>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('layout/footer.php'); ?>
</div>

<script>
// Set minimum date to today
document.getElementById('startDate').min = new Date().toISOString().split('T')[0];
document.getElementById('endDate').min = new Date().toISOString().split('T')[0];

// Ensure end date is not before start date
document.getElementById('startDate').addEventListener('change', function() {
    document.getElementById('endDate').min = this.value;
});
</script>