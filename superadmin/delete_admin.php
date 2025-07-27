<?php
session_start();
if (!isset($_SESSION['superadmin_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

if (isset($_GET['id'])) {
    $adminId = intval($_GET['id']);

    // Check if admin exists
    $check = $conn->prepare("SELECT * FROM admin WHERE id = ?");
    $check->bind_param("i", $adminId);
    $check->execute();
    $result = $check->get_result();

    if ($result && $result->num_rows > 0) {
        // Delete admin
        $delete = $conn->prepare("DELETE FROM admin WHERE id = ?");
        $delete->bind_param("i", $adminId);
        if ($delete->execute()) {
            echo "<script>alert('Admin deleted successfully.'); window.location.href='view_admins.php';</script>";
        } else {
            echo "<script>alert('Failed to delete admin.'); window.location.href='view_admins.php';</script>";
        }
    } else {
        echo "<script>alert('Admin not found.'); window.location.href='view_admins.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='view_admins.php';</script>";
}
?>
