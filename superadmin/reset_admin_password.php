<?php
session_start();
if (!isset($_SESSION['superadmin_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

if (isset($_GET['id'])) {
    $adminId = intval($_GET['id']);

    // If form submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPassword = trim($_POST['new_password']);

        if (!empty($newPassword)) {
            $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $newPassword, $adminId);

            if ($stmt->execute()) {
                echo "<script>alert('Password updated successfully!'); window.location.href='view_admins.php';</script>";
            } else {
                echo "<script>alert('Failed to update password.');</script>";
            }
        } else {
            echo "<script>alert('Password cannot be empty.');</script>";
        }
    }

    // Get admin username for display
    $stmt = $conn->prepare("SELECT username FROM admin WHERE id = ?");
    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
} else {
    echo "<script>alert('Invalid admin ID.'); window.location.href='view_admins.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Admin Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px #ccc;
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        input[type="password"], button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back {
            margin-top: 15px;
            text-align: center;
        }

        .back a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Reset Password for Admin:<br><span style="color:#007bff"><?= htmlspecialchars($admin['username']) ?></span></h2>

    <form method="POST">
        <label>Enter New Password:</label>
        <input type="password" name="new_password" required placeholder="New Password">
        <button type="submit">Reset Password</button>
    </form>

    <div class="back">
        <a href="view_admins.php">← Back to Admin List</a>
    </div>
</div>

</body>
</html>
