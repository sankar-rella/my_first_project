<?php
session_start();
include '../config/db.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $emp_id = $_SESSION['emp_id'];

    // Collect and sanitize form data
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $permanent_address = mysqli_real_escape_string($conn, $_POST['permanent_address']);
    $current_address = mysqli_real_escape_string($conn, $_POST['current_address']);
    $personal_email = mysqli_real_escape_string($conn, $_POST['personal_email']);
    $pan_card_no = strtoupper(mysqli_real_escape_string($conn, $_POST['pan_card_no']));
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $uan_number = mysqli_real_escape_string($conn, $_POST['uan_number']);
    $aadhaar_name = mysqli_real_escape_string($conn, $_POST['aadhaar_name']);
    $aadhaar_dob = mysqli_real_escape_string($conn, $_POST['aadhaar_dob']);
    $father_or_husband = mysqli_real_escape_string($conn, $_POST['father_or_husband']);
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status']);
    $aadhaar_number = mysqli_real_escape_string($conn, $_POST['aadhaar_number']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $account_holder = mysqli_real_escape_string($conn, $_POST['account_holder']);
    $account_number = mysqli_real_escape_string($conn, $_POST['account_number']);
    $ifsc_code = strtoupper(mysqli_real_escape_string($conn, $_POST['ifsc_code']));
    $branch_name = mysqli_real_escape_string($conn, $_POST['branch_name']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);

    // Prevent duplicate submission
    $check = mysqli_query($conn, "SELECT * FROM employee_details WHERE emp_id = '$emp_id'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Details already submitted.'); window.location.href='dashboard.php';</script>";
        exit();
    }

    // Insert query
    $insert = "INSERT INTO employee_details (
        emp_id, contact_number, permanent_address, current_address, personal_email,
        pan_card_no, dob, blood_group, uan_number, aadhaar_name, aadhaar_dob,
        father_or_husband, marital_status, aadhaar_number, mobile_number,
        account_holder, account_number, ifsc_code, branch_name, experience, department
    ) VALUES (
        '$emp_id', '$contact_number', '$permanent_address', '$current_address', '$personal_email',
        '$pan_card_no', '$dob', '$blood_group', '$uan_number', '$aadhaar_name', '$aadhaar_dob',
        '$father_or_husband', '$marital_status', '$aadhaar_number', '$mobile_number',
        '$account_holder', '$account_number', '$ifsc_code', '$branch_name', '$experience', '$department'
    )";

    if (mysqli_query($conn, $insert)) {
        echo "<script>alert('Details submitted successfully.'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error while submitting details.'); window.history.back();</script>";
    }

} else {
    echo "<script>alert('Invalid access.'); window.location.href='dashboard.php';</script>";
}
?>
