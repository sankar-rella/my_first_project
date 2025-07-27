<?php
session_start();
if (!isset($_SESSION['superadmin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include('../config/db.php');

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = trim($_POST['emp_id']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $created_by = $_SESSION['superadmin_username'];

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
    <title>Add Employee</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 40px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
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
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .msg {
            text-align: center;
            margin-bottom: 15px;
            color: #007bff;
            font-weight: bold;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
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
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
