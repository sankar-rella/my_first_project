<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}
$emp_id = $_SESSION['emp_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Details Form</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            overflow-x: hidden;
        }

        .bg-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        .form-container {
            background: rgba(0,0,0,0.7);
            padding: 30px;
            border-radius: 15px;
            max-width: 800px;
            margin: 50px auto;
            color: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
        }

       input[type="text"],
input[type="email"],
input[type="number"],
input[type="date"],
input[type="tel"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: none;
    border-radius: 5px;
    box-sizing: border-box;
}


        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 25px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Background Video -->
<video autoplay muted loop class="bg-video">
    <source src="assets/videos/BG_Emp_Details.mp4" type="video/mp4">
</video>

<!-- Form Content -->
<div class="form-container">
    <h2>Employee Details Form</h2>
    <form method="POST" action="save_employee_details.php">
        <input type="hidden" name="emp_id" value="<?php echo htmlspecialchars($emp_id); ?>">

        <label>Contact Number:</label>
<div style="display: flex; gap: 5px;">
    <select name="country_code" required>
        <option value="+91">+91 (India)</option>
        <option value="+1">+1 (USA)</option>
        <option value="+44">+44 (UK)</option>
        <!-- Add more countries if needed -->
    </select>
    <input type="tel" name="contact_number" id="contact_number" maxlength="10" pattern="\d{10}" required placeholder="Enter 10-digit mobile number">
</div>

        <label>Permanent Address</label>
        <input type="text" name="permanent_address" required>

        <label>Current Address</label>
        <input type="text" name="current_address" required>

        <label>Personal Email</label>
        <input type="email" name="personal_email" required>

        <label>PAN Card Number:</label>
<input type="text" name="pan_card_no" id="pan_card_no" maxlength="10" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Format: ABCDE1234F" required>


        <label>Date of Birth</label>
        <input type="date" name="dob" required>

       <label>Blood Group:</label>
<select name="blood_group" required>
    <option value="">-- Select --</option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
</select>


        <label>UAN Number:</label>
<input type="text" name="uan_number" maxlength="12" pattern="\d{12}" title="12 digit UAN number" required>

        <label>Name as per Aadhaar</label>
        <input type="text" name="aadhaar_name" required>

        <label>DOB as per Aadhaar</label>
        <input type="date" name="aadhaar_dob" required>

        <label>Father's/Husband's Name</label>
        <input type="text" name="father_or_husband" required>

        <label>Marital Status:</label>
<select name="marital_status" required>
    <option value="">-- Select --</option>
    <option value="Single">Single</option>
    <option value="Married">Married</option>
</select>


        <label>Aadhaar Number:</label>
<input type="text" name="aadhaar_number" maxlength="12" pattern="\d{12}" title="Enter valid 12-digit Aadhaar number" required>

  <label>Emergency Mobile Number(Parents or Guardian):</label>
<div style="display: flex; gap: 5px;">
    <select name="emergency_country_code" required> <!-- name fixed to avoid duplicate -->
        <option value="+91">+91 (India)</option>
        <option value="+1">+1 (USA)</option>
        <option value="+44">+44 (UK)</option>
    </select>
    <input type="tel" name="mobile_number" id="mobile_number" maxlength="10" pattern="\d{10}" required placeholder="Enter 10-digit mobile number">
</div>


        <label>Account Holder Name</label>
        <input type="text" name="account_holder" required>

     <label for="account_number">Bank Account Number:</label>
<input type="text" id="account_number" name="account_number" required pattern="\d{9,18}" title="Enter a valid account number (9-18 digits)" placeholder="Enter Account Number">

<label for="confirm_account_number">Confirm Bank Account Number:</label>
<input type="text" id="confirm_account_number" required placeholder="Confirm Account Number">

<span id="acc_error" style="color:red;"></span>

<label for="ifsc_code">IFSC Code:</label>
<input type="text" id="ifsc_code" name="ifsc_code" required pattern="[A-Z]{4}0[A-Z0-9]{6}" title="Enter a valid IFSC code (e.g., HDFC0001234)" placeholder="Enter IFSC Code">

<label for="confirm_ifsc_code">Confirm IFSC Code:</label>
<input type="text" id="confirm_ifsc_code" required placeholder="Confirm IFSC Code">

<span id="ifsc_error" style="color:red;"></span>



        <label>Branch Name</label>
        <input type="text" name="branch_name" required>

        <label>Experience (if any)</label>
        <input type="text" name="experience">

        <label>Department</label>
        <input type="text" name="department" required>

        <input type="submit" name="submit" value="Submit Details">

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const acc = document.getElementById('account_number').value.trim();
    const confirmAcc = document.getElementById('confirm_account_number').value.trim();
    const ifsc = document.getElementById('ifsc_code').value.trim().toUpperCase();
    const confirmIfsc = document.getElementById('confirm_ifsc_code').value.trim().toUpperCase();

    const accError = document.getElementById('acc_error');
    const ifscError = document.getElementById('ifsc_error');

    let valid = true;

    // Account validation
    if (acc !== confirmAcc) {
        accError.textContent = "Bank Account Number and Confirm Account Number must match.";
        valid = false;
    } else {
        accError.textContent = "";
    }

    // IFSC validation
    if (ifsc !== confirmIfsc) {
        ifscError.textContent = "IFSC Code and Confirm IFSC Code must match.";
        valid = false;
    } else {
        ifscError.textContent = "";
    }

    if (!valid) e.preventDefault();
});
</script>


    </form>

    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
</div>

</body>
</html>
