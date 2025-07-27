<?php
session_start();
require_once '../config/db.php';

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM super_admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // Note: Use hashed password in production!
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['superadmin_logged_in'] = true;
        $_SESSION['superadmin_username'] = $row['username'];
        $_SESSION['superadmin_id'] = $row['id'];

        header("Location: dashboard.php");
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Login</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e3f2fd, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }

        .logo {
            width: 80px;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #343a40;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .forgot-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
        }

        .forgot-link a {
            color: #007bff;
            text-decoration: none;
        }

        .forgot-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Logo (adjust path as needed) -->
    <img src="../employee/assets/images/provab.png" alt="Logo" class="logo">

    <h2>Super Admin Login</h2>

    <?php if ($login_error): ?>
        <div class="error"><?= $login_error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required autocomplete="off">
        <input type="password" name="password" placeholder="Password" required autocomplete="off">
        <button type="submit">Login</button>
        <div class="forgot-link">
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </form>
</div>

</body>
</html>
