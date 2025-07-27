<?php
session_start();
if (!isset($_SESSION['superadmin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include('../config/db.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM employee_details WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Employee details deleted successfully.'); window.location.href='view_employee_details.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $stmt->error . "'); window.location.href='view_employee_details.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid ID.'); window.location.href='view_employee_details.php';</script>";
}
?>
