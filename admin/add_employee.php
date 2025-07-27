<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include('../config/db.php');

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = trim($_POST['emp_id']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fallback if session variable missing
    $admin_user = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'admin';
    $created_by = 'admin_' . $admin_user;

    // Check if emp_id or email already exists
    $check = $conn->prepare("SELECT * FROM employee WHERE emp_id = ? OR email = ?");
    $check->bind_param("ss", $emp_id, $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $msg = "❌ Employee ID or Email already exists.";
    } else {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO employee (emp_id, email, password, created_by) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $emp_id, $email, $hashed_pass, $created_by);
        if ($stmt->execute()) {
            $msg = "✅ Employee added successfully!";
        } else {
            $msg = "❌ Failed to add employee.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Add Employee</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 40px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
            text-align: center;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #2575fc;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2575fc;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #1a5de8;
        }

        .msg {
            text-align: center;
            margin-bottom: 15px;
            color: #2575fc;
            font-weight: bold;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #2575fc;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Employee</h2>

    <?php if ($msg): ?>
        <div class="msg"><?php echo $msg; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="emp_id" placeholder="Employee ID" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Add Employee</button>
    </form>

    <div class="back-link">
        <a href="dashboard.php">&larr; Back to Dashboard</a>
    </div>
</div>

</body>
</html>
