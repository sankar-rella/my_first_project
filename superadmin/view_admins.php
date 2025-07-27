<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['superadmin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM admin");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Admins</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f3f6;
            padding: 30px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .reset-btn {
            background-color: #ffc107;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .back-button {
            position: absolute;
            top: 25px;
            left: 30px;
        }
        .back-button a {
            text-decoration: none;
            background: #28a745;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="back-button">
    <a href="dashboard.php">← Back to Dashboard</a>
</div>

<h2>Admin List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['password']) ?></td>
        <td>
            <a href="reset_admin_password.php?id=<?= $row['id'] ?>"><button class="btn reset-btn">Reset Password</button></a>
            <a href="delete_admin.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this admin?');"><button class="btn delete-btn">Delete</button></a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
