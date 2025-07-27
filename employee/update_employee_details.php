<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}

$emp_id = $_SESSION['emp_id'];
$conn = new mysqli("localhost", "root", "", "emp_details");

$sql = "SELECT * FROM employee_details WHERE emp_id = '$emp_id'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $employee = $result->fetch_assoc();
} else {
    echo "<script>alert('No data found to update.'); window.location.href='dashboard.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Employee Details</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        video.bg-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        .form-container {
            max-width: 900px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.92);
            padding: 30px;
            border-radius: 15px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .submit-btn {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        .error {
            color: red;
            font-size: 13px;
        }
    </style>

    <script>
        function validateForm() {
            const acc = document.getElementById('account_number').value;
            const confirmAcc = document.getElementById('confirm_account_number').value;
            const ifsc = document.getElementById('ifsc_code').value;
            const confirmIfsc = document.getElementById('confirm_ifsc_code').value;

            if (acc !== confirmAcc) {
                alert("Bank Account Number and Confirm Account Number must match.");
                return false;
            }

            if (ifsc !== confirmIfsc) {
                alert("IFSC Code and Confirm IFSC Code must match.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<video autoplay muted loop class="bg-video">
    <source src="assets/videos/background.mp4" type="video/mp4">
</video>

<div class="form-container">
    <h2>Update Your Information</h2>
    <form action="update_employee_details_save.php" method="POST" onsubmit="return validateForm()">
        <div class="form-row">
            <div class="form-group">
                <label>Contact Number</label>
                <input type="tel" name="contact_number" value="<?= $employee['contact_number'] ?>" pattern="^\d{10}$" required placeholder="+911234567890">
            </div>
            <div class="form-group">
                <label>Emergency Mobile Number</label>
                <input type="tel" name="mobile_number" value="<?= $employee['mobile_number'] ?>" pattern="^\d{10}$" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Permanent Address</label>
                <input type="text" name="permanent_address" value="<?= $employee['permanent_address'] ?>" required>
            </div>
            <div class="form-group">
                <label>Current Address</label>
                <input type="text" name="current_address" value="<?= $employee['current_address'] ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Personal Email</label>
                <input type="email" name="personal_email" value="<?= $employee['personal_email'] ?>" required>
            </div>
            <div class="form-group">
                <label>PAN Card Number</label>
                <input type="text" name="pan_card_no" value="<?= $employee['pan_card_no'] ?>" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" value="<?= $employee['dob'] ?>" required>
            </div>
            <div class="form-group">
                <label>Blood Group</label>
                <select name="blood_group" required>
                    <option value="">Select</option>
                    <?php
                    $groups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
                    foreach ($groups as $group) {
                        $selected = ($employee['blood_group'] == $group) ? "selected" : "";
                        echo "<option value='$group' $selected>$group</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>UAN Number</label>
                <input type="text" name="uan_number" value="<?= $employee['uan_number'] ?>" pattern="\d{12}" required>
            </div>
            <div class="form-group">
                <label>Aadhaar Name</label>
                <input type="text" name="aadhaar_name" value="<?= $employee['aadhaar_name'] ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Aadhaar DOB</label>
                <input type="date" name="aadhaar_dob" value="<?= $employee['aadhaar_dob'] ?>" required>
            </div>
            <div class="form-group">
                <label>Aadhaar Number</label>
                <input type="text" name="aadhaar_number" value="<?= $employee['aadhaar_number'] ?>" pattern="\d{12}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Father's / Husband's Name</label>
                <input type="text" name="father_or_husband" value="<?= $employee['father_or_husband'] ?>" required>
            </div>
            <div class="form-group">
                <label>Marital Status</label>
                <select name="marital_status" required>
                    <option value="">Select</option>
                    <option value="Single" <?= ($employee['marital_status'] == 'Single') ? 'selected' : '' ?>>Single</option>
                    <option value="Married" <?= ($employee['marital_status'] == 'Married') ? 'selected' : '' ?>>Married</option>
                    <option value="Divorced" <?= ($employee['marital_status'] == 'Divorced') ? 'selected' : '' ?>>Divorced</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Account Holder Name</label>
                <input type="text" name="account_holder" value="<?= $employee['account_holder'] ?>" required>
            </div>
            <div class="form-group">
                <label>Bank Account Number</label>
                <input type="text" id="account_number" name="account_number" value="<?= $employee['account_number'] ?>" pattern="\d{9,18}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Confirm Account Number</label>
                <input type="text" id="confirm_account_number" pattern="\d{9,18}" required>
            </div>
            <div class="form-group">
                <label>IFSC Code</label>
                <input type="text" id="ifsc_code" name="ifsc_code" value="<?= $employee['ifsc_code'] ?>" pattern="^[A-Z]{4}0[A-Z0-9]{6}$" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Confirm IFSC Code</label>
                <input type="text" id="confirm_ifsc_code" pattern="^[A-Z]{4}0[A-Z0-9]{6}$" required>
            </div>
            <div class="form-group">
                <label>Branch Name</label>
                <input type="text" name="branch_name" value="<?= $employee['branch_name'] ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Experience</label>
                <input type="text" name="experience" value="<?= $employee['experience'] ?>">
            </div>
            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" value="<?= $employee['department'] ?>" required>
            </div>
        </div>

        <button type="submit" class="submit-btn">Update Details</button>
    </form>
</div>

</body>
</html>
