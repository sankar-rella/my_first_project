<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "emp_details");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all employee details
$sql = "SELECT * FROM employee_details";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Details - Super Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-data {
            text-align: center;
            color: red;
            margin-top: 20px;
        }

        .delete {
    background-color: #dc3545;
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
    font-weight: bold;
}

    </style>
</head>
<body>
    <a href="dashboard.php" style="
    display: inline-block;
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    margin-bottom: 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
">
    ← Back to Dashboard
</a>


<h2>All Submitted Employee Details</h2>
<td>
    
<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Emp ID</th>
            <th>Contact Number</th>
            <th>Permanent Address</th>
            <th>Current Address</th>
            <th>Personal Email</th>
            <th>PAN Card No</th>
            <th>DOB</th>
            <th>Blood Group</th>
            <th>UAN Number</th>
            <th>Aadhaar Name</th>
            <th>Aadhaar DOB</th>
            <th>Father/Husband Name</th>
            <th>Marital Status</th>
            <th>Aadhaar Number</th>
            <th>Mobile Number</th>
            <th>Account Holder</th>
            <th>Account Number</th>
            <th>IFSC Code</th>
            <th>Branch Name</th>
            <th>Experience</th>
            <th>Department</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['emp_id']) ?></td>
                <td><?= htmlspecialchars($row['contact_number']) ?></td>
                <td><?= htmlspecialchars($row['permanent_address']) ?></td>
                <td><?= htmlspecialchars($row['current_address']) ?></td>
                <td><?= htmlspecialchars($row['personal_email']) ?></td>
                <td><?= htmlspecialchars($row['pan_card_no']) ?></td>
                <td><?= htmlspecialchars($row['dob']) ?></td>
                <td><?= htmlspecialchars($row['blood_group']) ?></td>
                <td><?= htmlspecialchars($row['uan_number']) ?></td>
                <td><?= htmlspecialchars($row['aadhaar_name']) ?></td>
                <td><?= htmlspecialchars($row['aadhaar_dob']) ?></td>
                <td><?= htmlspecialchars($row['father_or_husband']) ?></td>
                <td><?= htmlspecialchars($row['marital_status']) ?></td>
                <td><?= htmlspecialchars($row['aadhaar_number']) ?></td>
                <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                <td><?= htmlspecialchars($row['account_holder']) ?></td>
                <td><?= htmlspecialchars($row['account_number']) ?></td>
                <td><?= htmlspecialchars($row['ifsc_code']) ?></td>
                <td><?= htmlspecialchars($row['branch_name']) ?></td>
                <td><?= htmlspecialchars($row['experience']) ?></td>
                <td><?= htmlspecialchars($row['department']) ?></td>
                <td>
    
    <a class='action-btn delete' href='delete_employee_details.php?id=<?php echo $row["id"]; ?>' onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>

</td>

            </tr>
            
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p class="no-data">No employee details submitted yet.</p>
    
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
