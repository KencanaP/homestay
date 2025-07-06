<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../db.php');

// Handle Login Only
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userID']) && isset($_POST['password'])) {
    $userid = trim($_POST['userID']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($userid) || empty($password)) {
        header("Location: ../login.php?error=empty_fields");
        exit;
    }

    $prefix = strtoupper(substr($userid, 0, 1));
    $table = $id_col = $password_col = "";

    switch ($prefix) {
        case 'S':
            $table = 'Staff';
            $id_col = "Staff_ID";
            $password_col = "Staff_Password";
            break;
        case 'O':
            $table = 'OwnerHouse';
            $id_col = "Owner_ID";
            $password_col = "Owner_Password";
            break;
        case 'G':
            $table = 'Guest';
            $id_col = "Guest_ID";
            $password_col = "Guest_Password";
            break;
        default:
            header("Location: ../login.php?error=invalid_id");
            exit;
    }

    $query = "SELECT * FROM $table WHERE $id_col = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $userid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user[$password_col])) {
                session_regenerate_id(true);
                $_SESSION['userid'] = $userid;
                $_SESSION['role'] = $table;

                switch ($table) {
                    case 'Guest':
                        header("Location: ../guest/index.php");
                        break;
                    case 'OwnerHouse':
                        header("Location: ../owner/index.php");
                        break;
                    case 'Staff':
                        header("Location: ../admin/index.php");
                        break;
                }
                exit;
            } else {
                header("Location: ../login.php?error=wrong_password");
                exit;
            }
        } else {
            header("Location: ../login.php?error=user_not_found");
            exit;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../login.php?error=database_error");
        exit;
    }
} else {
    // If accessed directly without POST data
    header("Location: ../login.php?error=invalid_request");
    exit;
}
