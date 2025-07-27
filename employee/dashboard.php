<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}
if (isset($_SESSION['update_success'])) {
    echo "<script>alert('Details updated successfully.');</script>";
    unset($_SESSION['update_success']);
}
$emp_id = $_SESSION['emp_id'];
$emp_name = $_SESSION['emp_name'];

// DB connection
$conn = new mysqli("localhost", "root", "", "emp_details");

// Check if employee has submitted their details
$has_details = false;
$result = $conn->query("SELECT id FROM employee_details WHERE emp_id = '$emp_id'");
if ($result && $result->num_rows > 0) {
    $has_details = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Dashboard</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        video.bg-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        .dashboard-container {
            position: relative;
            z-index: 1;
            color: #fff;
            padding: 40px;
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            max-width: 600px;
            margin: 100px auto;
            border-radius: 20px;
        }

        h1 {
            margin-bottom: 10px;
            font-size: 32px;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            margin: 10px 8px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .button:hover {
            background-color: #218838;
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .update-btn {
            background-color: #ffc107;
            color: black;
        }

        .update-btn:hover {
            background-color: #e0a800;
        }

        .header-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-logo img {
            height: 80px;
        }

        .header-logo h2 {
            margin-top: 10px;
            color: #00cfff;
        }
    </style>
</head>
<body>

<!-- Background Video -->
<video autoplay muted loop class="bg-video">
    <source src="assets/videos/background.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
</video>

<!-- Dashboard Content -->
<div class="dashboard-container">
    <div class="header-logo">
        <img src="assets/images/logo.png" alt="Company Logo">
        <h2>Welcome to Provab Team</h2>
    </div>

    <h3>Hello, <?php echo htmlspecialchars($emp_name); ?>!</h3>

    <?php if (!$has_details): ?>
        <a href="employee_details_form.php" class="button">Fill Your Details</a>
    <?php else: ?>
        <a href="update_employee_details.php" class="button update-btn">Update Information</a>
    <?php endif; ?>

    <a href="logout.php" class="button logout-btn">Logout</a>
</div>

</body>
</html>
