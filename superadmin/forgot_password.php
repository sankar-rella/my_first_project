<?php
session_start();
require_once '../config/db.php';

$success = "";
$error = "";

// Simulating OTP sending — you should integrate actual mail/SMS API
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = trim($_POST['email_or_mobile']);

    $stmt = $conn->prepare("SELECT * FROM super_admin WHERE email = ? OR mobile = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $otp = rand(100000, 999999);
        $_SESSION['reset_otp'] = $otp;
        $_SESSION['reset_user'] = $input;

        // In real apps, send this OTP to email and mobile
        $success = "OTP has been sent to your registered email/mobile: <b>$otp</b> (simulated)";
    } else {
        $error = "No Super Admin found with this email or mobile.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Super Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 420px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #343a40;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
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

        .msg {
            margin: 15px 0;
            color: green;
            font-weight: bold;
        }

        .error {
            margin: 15px 0;
            color: red;
            font-weight: bold;
        }

        a.back-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            text-decoration: none;
            color: #007bff;
        }

        a.back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Forgot Password</h2>

    <?php if ($success): ?>
        <div class="msg"><?= $success ?></div>
        <a href="verify_otp.php" class="back-link">Proceed to OTP Verification</a>
    <?php else: ?>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="email_or_mobile" placeholder="Enter Email or Mobile" required>
            <button type="submit">Send OTP</button>
        </form>
        <a href="login.php" class="back-link">← Back to Login</a>
    <?php endif; ?>
</div>

</body>
</html>
