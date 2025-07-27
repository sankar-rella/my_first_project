<?php
session_start();

// Check if super admin is logged in
if (!isset($_SESSION['superadmin_logged_in']) || $_SESSION['superadmin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Super Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #343a40;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        header a.logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        header a.logout-btn:hover {
            background-color: #c82333;
        }

        .container {
            padding: 40px;
            text-align: center;
        }

        .dashboard-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin-top: 30px;
        }

        .dashboard-buttons a button {
            background-color: #007bff;
            color: white;
            padding: 14px 28px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            min-width: 250px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .dashboard-buttons a button:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            margin-top: 60px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>

    <header>
        <h1>Super Admin Dashboard</h1>
        <a class="logout-btn" href="logout.php">Logout</a>
    </header>

    <div class="container">
        <div class="dashboard-buttons">
            
            <a href="add_admin.php"><button>Add Admin</button></a>
            <a href="view_admins.php"><button>View Admins</button></a>
            <a href="add_employee.php"><button>Add Employee</button></a>
            <a href="view_employees.php"><button>View Employees</button></a>
            <a href="view_employee_details.php"><button>View Employee Details</button></a>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Employee Management System. All Rights Reserved.
    </footer>

</body>
</html>
