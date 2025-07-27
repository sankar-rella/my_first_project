<?php
include('../config/db.php');
session_start();

// Check if Admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Optional: Delete from employee_details table first if foreign key constraints exist
    $conn->query("DELETE FROM employee_details WHERE emp_id = $employee_id");

    // Then delete from employee table
    $delete_query = "DELETE FROM employee WHERE id = $employee_id";

    if ($conn->query($delete_query)) {
        echo "<script>alert('Employee deleted successfully.'); window.location.href='view_employees.php';</script>";
    } else {
        echo "<script>alert('Error deleting employee.'); window.location.href='view_employees.php';</script>";
    }
} else {
    header("Location: view_employees.php");
}
?>
