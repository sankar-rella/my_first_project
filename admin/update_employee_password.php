<?php
include('../config/db.php');
session_start();

// Check if Admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $new_password = $_POST['new_password'];

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password in database
    $sql = "UPDATE employee SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashed_password, $employee_id);

    if ($stmt->execute()) {
        echo "<script>alert('Password updated successfully!'); window.location.href='view_employees.php';</script>";
    } else {
        echo "<script>alert('Error updating password.'); window.history.back();</script>";
    }
}
?>
