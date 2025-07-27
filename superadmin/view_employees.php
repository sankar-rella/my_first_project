<?php
session_start();
if (!isset($_SESSION['superadmin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include('../config/db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Employees</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 14px 16px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-btn {
            text-decoration: none;
            margin: 0 5px;
            padding: 6px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .reset {
            background-color: #ffc107;
            color: black;
        }

        .delete {
            background-color: #dc3545;
            color: white;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 25px;
        }

        .back-btn a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Employee List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Email</th>
            <th>Created By</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>

        <?php
        $query = "SELECT * FROM employee ORDER BY id DESC";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['emp_id']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['created_by']}</td>
                        <td>{$row['created_at']}</td>
                        <td>
                            <a class='action-btn reset' href='reset_employee_password.php?id={$row['id']}'>Reset</a>
                            <a class='action-btn delete' href='delete_employee.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this employee?');\">Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No employees found.</td></tr>";
        }
        ?>
    </table>

    <div class="back-btn">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>

</body>
</html>
