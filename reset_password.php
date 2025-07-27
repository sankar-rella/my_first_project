<?php
include('./config/db.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    $username = trim($_POST['username']);
    $new_password = trim($_POST['new_password']);

    $table = $user_type == 'admin' ? 'admin' : 'employee';

    // Check if user exists
    $check = $conn->query("SELECT * FROM $table WHERE username = '$username'");
    if ($check && $check->num_rows > 0) {
        $update = $conn->query("UPDATE $table SET password = '$new_password' WHERE username = '$username'");
        if ($update) {
            $message = "<span style='color:green;'>✅ Password updated successfully.</span>";
        } else {
            $message = "<span style='color:red;'>❌ Failed to update password.</span>";
        }
    } else {
        $message = "<span style='color:red;'>❌ Username not found in $table table.</span>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial;
            background-color: #eef0f4;
        }

        .container {
            width: 400px;
            margin: 60px auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .message {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="POST">
            <label>User Type</label>
            <select name="user_type" required>
                <option value="">Select</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
            </select>

            <label>Username</label>
            <input type="text" name="username" placeholder="Enter username" required>

            <label>New Password</label>
            <input type="text" name="new_password" placeholder="Enter new password" required>

            <button type="submit">Reset Password</button>
        </form>
        <div class="message"><?= $message ?></div>
    </div>
</body>
</html>
