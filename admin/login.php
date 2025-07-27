<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}

require_once '../config/db.php';
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_input = trim($_POST["admin_input"]);
    $password = trim($_POST["password"]);

    $query = "SELECT * FROM admin WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $admin_input, $admin_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($password === $row["password"]) { // You should use password_hash in production
            $_SESSION["admin_logged_in"] = true;
            $_SESSION["admin_id"] = $row["id"];
            $_SESSION["admin_username"] = $row["username"];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username or email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: #0c1a2b;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: #ffffff;
      padding: 40px 35px;
      width: 100%;
      max-width: 420px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      animation: fadeIn 0.6s ease-in-out;
    }

    .login-box img {
      width: 80px;
      display: block;
      margin: 0 auto 20px;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #0c1a2b;
      font-weight: 600;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    .login-box input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #0077cc;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.3s ease;
    }

    .login-box input[type="submit"]:hover {
      background-color: #005fa3;
    }

    .error {
      margin-top: 15px;
      color: #ff4d4d;
      text-align: center;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }

    @media (max-width: 500px) {
      .login-box {
        padding: 30px 25px;
      }
    }
  </style>
</head>
<body>
  <div class="login-box">
    <img src="../employee/assets/images/provab.png" alt="Logo">
    <h2>Admin Login</h2>
    <form method="POST" action="">
      <input type="text" name="admin_input" placeholder="Username or Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
  </div>
</body>
</html>
