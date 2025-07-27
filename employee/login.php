<?php
session_start();
require_once("../config/db.php"); // Make sure this file contains DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_input = trim($_POST["emp_input"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT * FROM employee WHERE (emp_id = ? OR email = ?) LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $emp_input, $emp_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            if ($row["is_active"] == 1) {
                $_SESSION["emp_id"] = $row["emp_id"];
                $_SESSION["emp_name"] = $row["full_name"];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Account is inactive. Contact Admin.";
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(#0066cc, #003366);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: rgba(0,0,0,0.6);
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        .login-box img.logo {
            width: 40%;
    max-width: 150px;
    height: auto;
    margin-bottom: 10px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }

        .error {
            color: #ff4d4d;
        }
        @media (max-width: 600px) {
    .login-box {
        padding: 20px;
    }

    input {
        font-size: 16px;
        padding: 12px;
    }

    h2 {
        font-size: 22px;
    }
}

    </style>
</head>
<body>
<div class="login-box">
    <!-- Logo added here -->
    <img src="assets/images/provab.png" alt="Company Logo" class="logo">
    
    <h2>Employee Login</h2>
    <form method="POST">
        <input type="text" name="emp_input" placeholder="Employee ID or Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
</div>
</body>
</html>
