<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}

require_once '../config/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $admin_input = trim($_POST["admin_input"]);
    $password = trim($_POST["password"]);

    $query = "SELECT id, username, email, password FROM admin WHERE username = ? OR email = ? LIMIT 1";
    $stmt = $conn->prepare($query);

    if ($stmt) {

        $stmt->bind_param("ss", $admin_input, $admin_input);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {

            // Verify hashed password
            if (password_verify($password, $row["password"])) {

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

        $stmt->close();

    } else {
        $error = "Database error.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Segoe UI,Arial,sans-serif;
    background:#0c1a2b;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.login-box{

    width:420px;
    background:#fff;
    padding:40px;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);

}

.login-box img{

    width:90px;
    display:block;
    margin:auto;
    margin-bottom:20px;

}

.login-box h2{

    text-align:center;
    color:#0c1a2b;
    margin-bottom:25px;

}

.login-box input[type=text],
.login-box input[type=password]{

    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
    font-size:15px;

}

.login-box input[type=submit]{

    width:100%;
    padding:12px;
    background:#0077cc;
    color:#fff;
    border:none;
    border-radius:5px;
    font-size:16px;
    cursor:pointer;

}

.login-box input[type=submit]:hover{

    background:#005fa3;

}

.error{

    margin-top:15px;
    text-align:center;
    color:red;
    font-size:15px;

}

@media(max-width:500px){

.login-box{

width:90%;
padding:30px;

}

}

</style>

</head>

<body>

<div class="login-box">

<img src="../employee/assets/images/provab.png" alt="Logo">

<h2>Admin Login</h2>

<form method="POST">

<input
type="text"
name="admin_input"
placeholder="Username or Email"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<input
type="submit"
value="Login">

</form>

<?php
if(!empty($error)){
    echo "<p class='error'>$error</p>";
}
?>

</div>

</body>
</html>