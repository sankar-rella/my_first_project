<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        /* Background Video Styling */
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        header {
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        header img {
            height: 60px;
        }

        .logout a {
            background: #e74c3c;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .logout a:hover {
            background: #c0392b;
        }

        .container {
            height: calc(100vh - 80px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .dashboard {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            max-width: 900px;
            width: 100%;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        h1 {
            margin-bottom: 30px;
            color: #27a4c0ff;
            font-size: 32px;
        }

        .button-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }

        .dashboard-btn {
            background: linear-gradient(to right, #36d1dc, #5b86e5);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .dashboard-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .dashboard-btn::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.1);
            transition: left 0.3s;
        }

        .dashboard-btn:hover::after {
            left: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .dashboard {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<!-- Background Video -->
<video autoplay muted loop class="video-bg">
    <source src="../employee/assets/videos/BG_Emp_Details.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<!-- Header -->
<header>
    <img src="../employee/assets/images/provab.png" alt="Company Logo">
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
</header>

<!-- Dashboard -->
<div class="container">
    <div class="dashboard">
        <h1>Welcome Admin</h1>
        <div class="button-grid">
            <a class="dashboard-btn" href="add_employee.php">➕ Add Employee</a>
            <a class="dashboard-btn" href="view_employees.php">👁️ View Employees</a>
            <a class="dashboard-btn" href="view_employee_details.php">📄 View Employee Details</a>
            <a class="dashboard-btn" href="update_employee_details.php">✏️ Update Information</a>
        </div>
    </div>
</div>

</body>
</html>
