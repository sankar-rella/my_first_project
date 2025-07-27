<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$employee = null;
$emp_id = "";
$error = "";
$success = "";

$conn = new mysqli("localhost", "root", "", "emp_details");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fetch'])) {
        $emp_id = trim($_POST['emp_id']);
        $sql = "SELECT * FROM employee_details WHERE emp_id = '$emp_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $employee = $result->fetch_assoc();
        } else {
            $error = "Employee ID not found.";
        }
    } elseif (isset($_POST['update'])) {
        // Sanitize and retrieve all fields
        $emp_id = $_POST['emp_id'];
        $contact_number = $_POST['contact_number'];
        $mobile_number = $_POST['mobile_number'];
        $permanent_address = $_POST['permanent_address'];
        $current_address = $_POST['current_address'];
        $personal_email = $_POST['personal_email'];
        $pan_card_no = $_POST['pan_card_no'];
        $dob = $_POST['dob'];
        $blood_group = $_POST['blood_group'];
        $uan_number = $_POST['uan_number'];
        $aadhaar_name = $_POST['aadhaar_name'];
        $aadhaar_dob = $_POST['aadhaar_dob'];
        $aadhaar_number = $_POST['aadhaar_number'];
        $father_or_husband = $_POST['father_or_husband'];
        $marital_status = $_POST['marital_status'];
        $account_holder = $_POST['account_holder'];
        $account_number = $_POST['account_number'];
        $ifsc_code = $_POST['ifsc_code'];
        $branch_name = $_POST['branch_name'];
        $experience = $_POST['experience'];
        $department = $_POST['department'];

        $update = "UPDATE employee_details SET 
            contact_number='$contact_number',
            mobile_number='$mobile_number',
            permanent_address='$permanent_address',
            current_address='$current_address',
            personal_email='$personal_email',
            pan_card_no='$pan_card_no',
            dob='$dob',
            blood_group='$blood_group',
            uan_number='$uan_number',
            aadhaar_name='$aadhaar_name',
            aadhaar_dob='$aadhaar_dob',
            aadhaar_number='$aadhaar_number',
            father_or_husband='$father_or_husband',
            marital_status='$marital_status',
            account_holder='$account_holder',
            account_number='$account_number',
            ifsc_code='$ifsc_code',
            branch_name='$branch_name',
            experience='$experience',
            department='$department'
        WHERE emp_id='$emp_id'";

        if ($conn->query($update)) {
            $success = "Employee information updated successfully.";
        } else {
            $error = "Failed to update employee.";
        }

        $sql = "SELECT * FROM employee_details WHERE emp_id = '$emp_id'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $employee = $result->fetch_assoc();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #00796b;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 6px;
        }

        input, select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #bbb;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group.half {
            flex: 1 1 45%;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            background: #00796b;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background: #004d40;
        }

        .msg {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
        }

        .error { color: red; }
        .success { color: green; }

        .back-btn {
            text-align: right;
        }

        @media (max-width: 768px) {
            .form-group.half {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="back-btn">
        <a href="dashboard.php" class="btn">← Back to Dashboard</a>
    </div>

    <h2>Update Employee Details</h2>

    <?php if (!empty($error)) echo "<div class='msg error'>$error</div>"; ?>
    <?php if (!empty($success)) echo "<div class='msg success'>$success</div>"; ?>

    <form method="POST">
        <div class="form-group">
            <label for="emp_id">Enter Employee ID to Fetch:</label>
            <input type="text" name="emp_id" value="<?= htmlspecialchars($emp_id) ?>" required>
            <button class="btn" type="submit" name="fetch">Fetch</button>
        </div>
    </form>

    <?php if ($employee): ?>
        <form method="POST">
            <input type="hidden" name="update" value="1">
            <input type="hidden" name="emp_id" value="<?= htmlspecialchars($employee['emp_id']) ?>">

            <div class="form-row">
                <div class="form-group half">
                    <label>Contact Number</label>
                    <input type="text" name="contact_number" value="<?= htmlspecialchars($employee['contact_number']) ?>" required>
                </div>
                <div class="form-group half">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile_number" value="<?= htmlspecialchars($employee['mobile_number']) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>Permanent Address</label>
                    <input type="text" name="permanent_address" value="<?= htmlspecialchars($employee['permanent_address']) ?>" required>
                </div>
                <div class="form-group half">
                    <label>Current Address</label>
                    <input type="text" name="current_address" value="<?= htmlspecialchars($employee['current_address']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Personal Email</label>
                <input type="email" name="personal_email" value="<?= htmlspecialchars($employee['personal_email']) ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>PAN Card No (e.g. ABCDE1234F)</label>
                    <input type="text" name="pan_card_no" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" value="<?= htmlspecialchars($employee['pan_card_no']) ?>" required>
                </div>
                <div class="form-group half">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" value="<?= htmlspecialchars($employee['dob']) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>Blood Group</label>
                    <select name="blood_group" required>
                        <option value="">Select</option>
                        <?php
                        $bloods = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                        foreach ($bloods as $bg) {
                            echo "<option value='$bg'" . ($employee['blood_group'] === $bg ? ' selected' : '') . ">$bg</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group half">
                    <label>UAN Number</label>
                    <input type="text" name="uan_number" pattern="[0-9]{12}" value="<?= htmlspecialchars($employee['uan_number']) ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>Name as per Aadhaar</label>
                    <input type="text" name="aadhaar_name" value="<?= htmlspecialchars($employee['aadhaar_name']) ?>" required>
                </div>
                <div class="form-group half">
                    <label>Date of Birth (Aadhaar)</label>
                    <input type="date" name="aadhaar_dob" value="<?= htmlspecialchars($employee['aadhaar_dob']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Aadhaar Number</label>
                <input type="text" name="aadhaar_number" pattern="[0-9]{12}" value="<?= htmlspecialchars($employee['aadhaar_number']) ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>Father's/Husband's Name</label>
                    <input type="text" name="father_or_husband" value="<?= htmlspecialchars($employee['father_or_husband']) ?>" required>
                </div>
                <div class="form-group half">
                    <label>Marital Status</label>
                    <select name="marital_status" required>
                        <option value="">Select</option>
                        <option value="Single" <?= $employee['marital_status'] === 'Single' ? 'selected' : '' ?>>Single</option>
                        <option value="Married" <?= $employee['marital_status'] === 'Married' ? 'selected' : '' ?>>Married</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Account Holder Name</label>
                <input type="text" name="account_holder" value="<?= htmlspecialchars($employee['account_holder']) ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label>Account Number</label>
                    <input type="text" name="account_number" pattern="[0-9]{9,18}" value="<?= htmlspecialchars($employee['account_number']) ?>" required>
                </div>
                <div class="form-group half">
                    <label>IFSC Code</label>
                    <input type="text" name="ifsc_code" pattern="[A-Z]{4}0[A-Z0-9]{6}" value="<?= htmlspecialchars($employee['ifsc_code']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Branch Name</label>
                <input type="text" name="branch_name" value="<?= htmlspecialchars($employee['branch_name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Experience</label>
                <input type="text" name="experience" value="<?= htmlspecialchars($employee['experience']) ?>">
            </div>

            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" value="<?= htmlspecialchars($employee['department']) ?>" required>
            </div>

            <button class="btn" type="submit">Update</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
