<?php
session_start();
include('layout/header.php');

$host = 'localhost';
$db   = 'homestay';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$staffID = 'S001'; // You can get this from session or login

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_name = $_POST['staff_name'];
    $staff_phone = $_POST['staff_phone'];
    $staff_address = $_POST['staff_address'];
    $job_description = $_POST['job_description'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password match if provided
    if (!empty($new_password) && $new_password !== $confirm_password) {
        $_SESSION['error'] = 'New passwords do not match!';
    } else {
        // Update query
        if (!empty($new_password)) {
            $sql = "UPDATE staff SET Staff_Name = ?, Staff_PhoneNo = ?, Staff_Address = ?, Job_Description = ?, Staff_Password = ? WHERE Staff_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $staff_name, $staff_phone, $staff_address, $job_description, $new_password, $staffID);
        } else {
            $sql = "UPDATE staff SET Staff_Name = ?, Staff_PhoneNo = ?, Staff_Address = ?, Job_Description = ? WHERE Staff_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $staff_name, $staff_phone, $staff_address, $job_description, $staffID);
        }

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Profile updated successfully!';
            header('Location: worker-profile.php');
            exit();
        } else {
            $_SESSION['error'] = 'Error updating profile: ' . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch current staff data
$sql = "SELECT * FROM staff WHERE Staff_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $staffID);
$stmt->execute();
$result = $stmt->get_result();
$staff = $result->fetch_assoc();
$stmt->close();
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">
                <i class="fas fa-user-edit text-secondary"></i> Edit Worker Profile
            </h1>
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
                    <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-secondary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-user-cog"></i> Update Profile Information
                                </h5>
                                <div class="btn-group" role="group">
                                    <a href="worker-profile.php" class="btn btn-light btn-sm">
                                        <i class="fas fa-user"></i> Profile
                                    </a>
                                    <a href="worker-schedule.php" class="btn btn-light btn-sm">
                                        <i class="fas fa-calendar"></i> Schedule
                                    </a>
                                    <a href="worker-leave.php" class="btn btn-light btn-sm">
                                        <i class="fas fa-calendar-times"></i> Leave
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <form method="POST" action="" novalidate>
                                <div class="row">
                                    <!-- Personal Information Section -->
                                    <div class="col-12">
                                        <div class="section-header mb-4">
                                            <h6 class="text-secondary border-bottom pb-2">
                                                <i class="fas fa-user"></i> Personal Information
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="staff_name" class="form-label fw-bold">
                                            <i class="fas fa-user text-secondary"></i> Full Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control form-control-lg"
                                            id="staff_name"
                                            name="staff_name"
                                            value="<?= htmlspecialchars($staff['Staff_Name']) ?>"
                                            required>
                                        <div class="invalid-feedback">
                                            Please provide a valid name.
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="staff_id" class="form-label fw-bold">
                                            <i class="fas fa-id-badge text-secondary"></i> Staff ID
                                        </label>
                                        <input type="text"
                                            class="form-control form-control-lg bg-light"
                                            id="staff_id"
                                            value="<?= htmlspecialchars($staff['Staff_ID']) ?>"
                                            readonly>
                                        <small class="form-text text-muted">Staff ID cannot be changed</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="staff_phone" class="form-label fw-bold">
                                            <i class="fas fa-phone text-secondary"></i> Phone Number <span class="text-danger">*</span>
                                        </label>
                                        <input type="tel"
                                            class="form-control form-control-lg"
                                            id="staff_phone"
                                            name="staff_phone"
                                            value="<?= htmlspecialchars($staff['Staff_PhoneNo']) ?>"
                                            pattern="[0-9]{10,15}"
                                            required>
                                        <div class="invalid-feedback">
                                            Please provide a valid phone number.
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pay_per_session" class="form-label fw-bold">
                                            <i class="fas fa-money-bill-wave text-secondary"></i> Pay Per Session
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">RM</span>
                                            <input type="text"
                                                class="form-control form-control-lg bg-light"
                                                id="pay_per_session"
                                                value="<?= number_format($staff['Pay_Per_Session'], 2) ?>"
                                                readonly>
                                        </div>
                                        <small class="form-text text-muted">Contact HR to change pay rate</small>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="staff_address" class="form-label fw-bold">
                                            <i class="fas fa-map-marker-alt text-secondary"></i> Address <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control form-control-lg"
                                            id="staff_address"
                                            name="staff_address"
                                            rows="3"
                                            required><?= htmlspecialchars($staff['Staff_Address']) ?></textarea>
                                        <div class="invalid-feedback">
                                            Please provide your address.
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label for="job_description" class="form-label fw-bold">
                                            <i class="fas fa-briefcase text-secondary"></i> Job Description
                                        </label>
                                        <input type="text"
                                            class="form-control form-control-lg"
                                            id="job_description"
                                            name="job_description"
                                            value="<?= htmlspecialchars($staff['Job_Description']) ?>">
                                    </div>

                                    <!-- Security Section -->
                                    <div class="col-12">
                                        <div class="section-header mb-4">
                                            <h6 class="text-secondary border-bottom pb-2">
                                                <i class="fas fa-lock"></i> Security Settings
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="new_password" class="form-label fw-bold">
                                            <i class="fas fa-key text-secondary"></i> New Password
                                        </label>
                                        <input type="password"
                                            class="form-control form-control-lg"
                                            id="new_password"
                                            name="new_password"
                                            placeholder="Leave blank to keep current password">
                                        <small class="form-text text-muted">Leave blank if you don't want to change password</small>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="confirm_password" class="form-label fw-bold">
                                            <i class="fas fa-key text-secondary"></i> Confirm New Password
                                        </label>
                                        <input type="password"
                                            class="form-control form-control-lg"
                                            id="confirm_password"
                                            name="confirm_password"
                                            placeholder="Confirm new password">
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a href="worker-profile.php" class="btn btn-outline-secondary btn-lg me-md-2">
                                                <i class="fas fa-times"></i> Cancel
                                            </a>
                                            <button type="submit" class="btn btn-secondary btn-lg">
                                                <i class="fas fa-save"></i> Update Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('layout/footer.php'); ?>
</div>

<!-- Form Validation Script -->
<script>
    // Bootstrap form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Password confirmation validation
    document.getElementById('confirm_password').addEventListener('input', function() {
        const password = document.getElementById('new_password').value;
        const confirmPassword = this.value;

        if (password !== '' && confirmPassword !== '') {
            if (password !== confirmPassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        } else {
            this.setCustomValidity('');
        }
    });

    document.getElementById('new_password').addEventListener('input', function() {
        const confirmPassword = document.getElementById('confirm_password');
        if (this.value === '') {
            confirmPassword.value = '';
            confirmPassword.setCustomValidity('');
        }
    });
</script>

<!-- Custom CSS -->
<style>
    .section-header h6 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-control-lg {
        border-radius: 0.5rem;
        border: 2px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus {
        border-color: #6c757d;
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.5rem;
    }

    .card {
        border-radius: 1rem;
    }

    .card-header {
        border-radius: 1rem 1rem 0 0 !important;
    }

    .form-label {
        margin-bottom: 0.5rem;
        color: #5a5c69;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .bg-secondary {
        background-color: #6c757d !important;
    }

    .alert {
        border-radius: 0.5rem;
        border: none;
    }

    .invalid-feedback {
        display: block;
    }

    .was-validated .form-control:invalid {
        border-color: #e74a3b;
    }

    .was-validated .form-control:valid {
        border-color: #28a745;
    }

    /* Additional grey theme enhancements */
    .border-bottom {
        border-bottom: 2px solid #dee2e6 !important;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-color: #e3e6f0;
        color: #6c757d;
    }

    .form-control:focus {
        border-color: #6c757d;
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
    }

    .card-header.bg-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    }

    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(108, 117, 125, 0.175) !important;
    }
</style>

<?php $conn->close(); ?>