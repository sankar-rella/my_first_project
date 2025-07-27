<?php
$conn = new mysqli("localhost", "root", "", "emp_details");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
