<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../db.php');

// Handle Registration Only
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reg-name'])) {
    $name     = trim($_POST['reg-name']);
    $email    = trim($_POST['reg-email']);
    $phone    = trim($_POST['reg-phone']);
    $age      = trim($_POST['reg-age']);
    $password = trim($_POST['reg-password']);
    $confirm  = trim($_POST['reg-confirm']);

    // Validate input
    if (empty($name) || empty($email) || empty($phone) || empty($age) || empty($password)) {
        header("Location: ../login.php?error=empty_fields");
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.php?error=invalid_email");
        exit;
    }

    // Validate age
    if (!is_numeric($age) || $age < 1 || $age > 99) {
        header("Location: ../login.php?error=invalid_age");
        exit;
    }

    // Validate phone number (basic check)
    if (!preg_match('/^[0-9+\-\s()]+$/', $phone)) {
        header("Location: ../login.php?error=invalid_phone");
        exit;
    }

    // Check password match
    if ($password !== $confirm) {
        header("Location: ../login.php?error=password_mismatch");
        exit;
    }

    // Check password strength (minimum 6 characters)
    if (strlen($password) < 6) {
        header("Location: ../login.php?error=password_too_short");
        exit;
    }

    // Check if email already exists
    $email_check = mysqli_prepare($con, "SELECT Guest_ID FROM Guest WHERE Guest_Email = ?");
    if ($email_check) {
        mysqli_stmt_bind_param($email_check, "s", $email);
        mysqli_stmt_execute($email_check);
        mysqli_stmt_store_result($email_check);

        if (mysqli_stmt_num_rows($email_check) > 0) {
            mysqli_stmt_close($email_check);
            header("Location: ../login.php?error=email_exists");
            exit;
        }
        mysqli_stmt_close($email_check);
    }

    // Check if phone already exists
    $phone_check = mysqli_prepare($con, "SELECT Guest_ID FROM Guest WHERE Guest_PhoneNo = ?");
    if ($phone_check) {
        mysqli_stmt_bind_param($phone_check, "s", $phone);
        mysqli_stmt_execute($phone_check);
        mysqli_stmt_store_result($phone_check);

        if (mysqli_stmt_num_rows($phone_check) > 0) {
            mysqli_stmt_close($phone_check);
            header("Location: ../login.php?error=phone_exists");
            exit;
        }
        mysqli_stmt_close($phone_check);
    }

    // Generate unique Guest ID
    do {
        $new_id = "G" . rand(10000, 99999);
        $check_stmt = mysqli_prepare($con, "SELECT Guest_ID FROM Guest WHERE Guest_ID = ?");
        mysqli_stmt_bind_param($check_stmt, "s", $new_id);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);
    } while (mysqli_stmt_num_rows($check_stmt) > 0);

    mysqli_stmt_close($check_stmt);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new guest
    $stmt = mysqli_prepare($con, "INSERT INTO Guest (Guest_ID, Guest_Name, Guest_PhoneNo, Guest_Age, Guest_Email, Guest_Password) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $new_id, $name, $phone, $age, $email, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: ../login.php?success=registration_successful&id=" . $new_id);
            exit;
        } else {
            mysqli_stmt_close($stmt);
            header("Location: ../login.php?error=registration_failed");
            exit;
        }
    } else {
        header("Location: ../login.php?error=database_error");
        exit;
    }
} else {
    // If accessed directly without POST data
    header("Location: ../login.php?error=invalid_request");
    exit;
}
