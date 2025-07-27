<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}
$emp_id = $_SESSION['emp_id'];
include '../config/db.php';

// Check if employee has already submitted details
$sql = "SELECT * FROM employee_details WHERE emp_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $emp_id);
$stmt->execute();
$result = $stmt->get_result();
$hasSubmitted = $result->num_rows > 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Details</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            overflow-x: hidden;
        }

        .bg-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        .form-container {
            background: rgba(0,0,0,0.7);
            padding: 30px;
            border-radius: 15px;
            max-width: 800px;
            margin: 50px auto;
            color: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            text-align: center;
        }

        .btn {
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<video autoplay muted loop class="bg-video">
    <source src="assets/videos/BG_Emp_Details.mp4" type="video/mp4">
</video>

<div class="form-container">
    <?php if ($hasSubmitted): ?>
        <h2>You have already submitted your details.</h2>
        <a href="update_employee_details.php" class="btn">Update Information</a>
    <?php else: ?>
        <h2>Employee Details Form</h2>
        <a href="fill_employee_details.php" class="btn">Fill Details</a>
    <?php endif; ?>
    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
</div>

</body>
</html>
