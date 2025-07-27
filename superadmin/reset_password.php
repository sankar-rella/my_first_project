<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    header("Location: forgot_password.php");
    exit();
}

$msg = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $user = $_SESSION['reset_user'];

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // If you want to store password as plain text (not recommended):
        $stmt = $conn->prepare("UPDATE super_admin SET password = ? WHERE email = ? OR mobile = ?");
        $stmt->bind_param("sss", $new_password, $user, $user);
        $stmt->execute();

        $msg = "Password reset successfully.";
        session_destroy(); // Clear session
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', sans-serif;
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

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 420px;
            max-width: 95%;
            text-align: center;
            margin: 5% auto;
        }

        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .msg {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        a {
            font-size: 14px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<video autoplay muted loop class="bg-video">
    <source src="../assets/videos/background.mp4" type="video/mp4">
</video>

<div class="container">
    <img src="../employee/assets/images/provab.png" class="logo" alt="Logo">
    <h2>Reset Your Password</h2>
    <?php if ($msg): ?>
        <div class="msg"><?= $msg ?></div>
        <a href="login.php">← Go to Login</a>
    <?php else: ?>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Set Password</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
