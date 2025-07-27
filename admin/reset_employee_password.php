<?php
include('../config/db.php');
session_start();

// ✅ Check Admin login instead of Super Admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$employee_id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Employee Password</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .form-box {
            width: 400px;
            margin: auto;
            background: #fff;
            padding: 25px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            text-decoration: none;
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Reset Password</h2>
    <form method="post" action="update_employee_password.php">
        <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>

        <input type="submit" value="Update Password">
    </form>

    <div class="back-link">
        <a href="view_employees.php">← Back to Employee List</a>
    </div>
</div>

</body>
</html>
