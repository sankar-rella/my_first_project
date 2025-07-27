<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['superadmin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = trim($_POST["admin_username"]);
    $admin_email = trim($_POST["admin_email"]);
    $admin_password = trim($_POST["admin_password"]);

    $check_query = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Admin with this email already exists!";
    } else {
        $insert = "INSERT INTO admin (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("sss", $admin_username, $admin_email, $admin_password);
        if ($stmt->execute()) {
            $success = "Admin added successfully!";
        } else {
            $error = "Something went wrong!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fc;
            padding: 30px;
        }
        .container {
            width: 450px;
            margin: auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin: 12px 0 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 3px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .message {
            text-align: center;
            margin-top: 15px;
            color: green;
        }
        .error {
            color: red;
            text-align: center;
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

<div class="container">
    <h2>Add Admin</h2>
    <?php if ($success): ?><p class="message"><?= $success ?></p><?php endif; ?>
    <?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="admin_username" required>

        <label>Email:</label>
        <input type="email" name="admin_email" required>

        <label>Password:</label>
        <input type="text" name="admin_password" required>

        <input type="submit" value="Add Admin">
    </form>
</div>

</body>
</html>
