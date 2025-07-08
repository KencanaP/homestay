<?php
session_start();

// Database connection
$host = 'localhost';
$db   = 'homestay';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Get form data
    $staffID = 'S001'; // Replace with session variable: $_SESSION['staff_id'] when you have login system
    $absenceType = trim($_POST['item_name']);
    $absenceReason = trim($_POST['item_desc']);
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'] ?? $startDate; // Use start date if end date not provided
    
    // Validate required fields
    if (empty($absenceType) || empty($absenceReason) || empty($startDate)) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: worker-leave.php");
        exit();
    }
    
    // Handle file upload
    $fileName = '';
    $uploadDir = 'uploads/leave_attachments/';
    
    // Create upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        
        $fileType = $_FILES['img']['type'];
        $fileSize = $_FILES['img']['size'];
        $tempFile = $_FILES['img']['tmp_name'];
        
        // Validate file type
        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['error'] = "Only JPG, PNG, GIF, and PDF files are allowed.";
            header("Location: worker-leave.php");
            exit();
        }
        
        // Validate file size
        if ($fileSize > $maxFileSize) {
            $_SESSION['error'] = "File size must be less than 5MB.";
            header("Location: worker-leave.php");
            exit();
        }
        
        // Generate unique filename
        $fileExtension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $fileName = $staffID . '_' . date('YmdHis') . '.' . $fileExtension;
        $uploadPath = $uploadDir . $fileName;
        
        // Move uploaded file
        if (!move_uploaded_file($tempFile, $uploadPath)) {
            $_SESSION['error'] = "Failed to upload file.";
            header("Location: worker-leave.php");
            exit();
        }
    }
    
    // Calculate date range for multiple entries if needed
    $currentDate = new DateTime($startDate);
    $endDateObj = new DateTime($endDate);
    
    // Insert absence record(s) - one for each date in the range
    $stmt = $conn->prepare("INSERT INTO absence (Staff_ID, Absence_Type, Absence_Reason, File_Attachment, Absence_Date) VALUES (?, ?, ?, ?, ?)");
    
    $insertedCount = 0;
    while ($currentDate <= $endDateObj) {
        $formattedDate = $currentDate->format('Y-m-d');
        
        if ($stmt->bind_param("sssss", $staffID, $absenceType, $absenceReason, $fileName, $formattedDate)) {
            if ($stmt->execute()) {
                $insertedCount++;
            } else {
                $_SESSION['error'] = "Error submitting leave application: " . $stmt->error;
                header("Location: worker-leave.php");
                exit();
            }
        }
        
        $currentDate->modify('+1 day');
    }
    
    $stmt->close();
    
    if ($insertedCount > 0) {
        $_SESSION['success'] = "Leave application submitted successfully for $insertedCount day(s).";
    } else {
        $_SESSION['error'] = "No leave records were created.";
    }
    
    header("Location: worker-leave.php");
    exit();
    
} else {
    // If not POST request, redirect to form
    header("Location: worker-leave.php");
    exit();
}

$conn->close();
?>