<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}

$emp_id = $_SESSION['emp_id'];

// Connect to DB
$conn = new mysqli("localhost", "root", "", "emp_details");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize & collect form data
$contact_number     = $_POST['contact_number'];
$permanent_address  = $_POST['permanent_address'];
$current_address    = $_POST['current_address'];
$personal_email     = $_POST['personal_email'];
$pan_card_no        = $_POST['pan_card_no'];
$dob                = $_POST['dob'];
$blood_group        = $_POST['blood_group'];
$uan_number         = $_POST['uan_number'];
$aadhaar_name       = $_POST['aadhaar_name'];
$aadhaar_dob        = $_POST['aadhaar_dob'];
$father_or_husband  = $_POST['father_or_husband'];
$marital_status     = $_POST['marital_status'];
$aadhaar_number     = $_POST['aadhaar_number'];
$mobile_number      = $_POST['mobile_number'];
$account_holder     = $_POST['account_holder'];
$account_number     = $_POST['account_number'];
$ifsc_code          = $_POST['ifsc_code'];
$branch_name        = $_POST['branch_name'];
$experience         = $_POST['experience'];
$department         = $_POST['department'];

// Update Query
$sql = "UPDATE employee_details SET
    contact_number = ?, permanent_address = ?, current_address = ?, personal_email = ?, pan_card_no = ?, dob = ?, blood_group = ?, uan_number = ?, aadhaar_name = ?, aadhaar_dob = ?, father_or_husband = ?, marital_status = ?, aadhaar_number = ?, mobile_number = ?, account_holder = ?, account_number = ?, ifsc_code = ?, branch_name = ?, experience = ?, department = ?
    WHERE emp_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssssi",
    $contact_number, $permanent_address, $current_address, $personal_email,
    $pan_card_no, $dob, $blood_group, $uan_number, $aadhaar_name, $aadhaar_dob,
    $father_or_husband, $marital_status, $aadhaar_number, $mobile_number,
    $account_holder, $account_number, $ifsc_code, $branch_name, $experience,
    $department, $emp_id
);

if ($stmt->execute()) {
    echo "<script>alert('Details updated successfully!'); window.location.href = 'dashboard.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
