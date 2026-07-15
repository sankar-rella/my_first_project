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

    // Hash the password before saving
    $admin_password = password_hash(trim($_POST["admin_password"]), PASSWORD_DEFAULT);

    // Check if email already exists
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

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>

    <style>

        body{
            font-family:'Segoe UI',sans-serif;
            background:#f7f9fc;
            padding:30px;
        }

        .container{
            width:450px;
            margin:auto;
            background:#fff;
            padding:25px 30px;
            border-radius:10px;
            box-shadow:0 0 15px rgba(0,0,0,.1);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
        }

        label{
            display:block;
            margin:12px 0 5px;
        }

        input[type=text],
        input[type=email],
        input[type=password]{

            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:6px;

        }

        input[type=submit]{

            width:100%;
            padding:10px;
            margin-top:15px;
            border:none;
            background:#007bff;
            color:#fff;
            font-size:16px;
            border-radius:6px;
            cursor:pointer;

        }

        input[type=submit]:hover{

            background:#0056b3;

        }

        .message{

            color:green;
            text-align:center;
            margin-bottom:15px;

        }

        .error{

            color:red;
            text-align:center;
            margin-bottom:15px;

        }

        .back-button{

            position:absolute;
            top:20px;
            left:20px;

        }

        .back-button a{

            text-decoration:none;
            color:#fff;
            background:#28a745;
            padding:10px 15px;
            border-radius:5px;

        }

    </style>

</head>

<body>

<div class="back-button">
    <a href="dashboard.php">← Back to Dashboard</a>
</div>

<div class="container">

    <h2>Add Admin</h2>

    <?php if($success): ?>
        <p class="message"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="admin_username" required>

        <label>Email</label>
        <input type="email" name="admin_email" required>

        <label>Password</label>
        <input type="password" name="admin_password" required>

        <input type="submit" value="Add Admin">

    </form>

</div>

</body>
</html>