<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';

$query = "SELECT * FROM employee_details ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - View Employee Details</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .top-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .back-btn,
        .excel-btn {
            background-color: #004d99;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .back-btn:hover,
        .excel-btn:hover {
            background-color: #003366;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 13px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #004d99;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .scroll-container {
            overflow-x: auto;
        }

        .pdf-btn {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .pdf-btn:hover {
            background-color: #1e7e34;
        }

        .pdf-form {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="top-buttons">
        <a class="back-btn" href="dashboard.php">← Back to Dashboard</a>

        <form method="post" action="export_excel.php">
            <button type="submit" class="excel-btn">Export All to Excel</button>
        </form>
    </div>

    <h2>All Employee Details</h2>

    <div class="scroll-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Emp ID</th>
                <th>Contact No</th>
                <th>Permanent Address</th>
                <th>Current Address</th>
                <th>Personal Email</th>
                <th>PAN Card No</th>
                <th>DOB</th>
                <th>Blood Group</th>
                <th>UAN Number</th>
                <th>Name as per Aadhaar</th>
                <th>DOB (Aadhaar)</th>
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
                <th>Download PDF</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['emp_id']}</td>
                        <td>{$row['contact_number']}</td>
                        <td>{$row['permanent_address']}</td>
                        <td>{$row['current_address']}</td>
                        <td>{$row['personal_email']}</td>
                        <td>{$row['pan_card_no']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['blood_group']}</td>
                        <td>{$row['uan_number']}</td>
                        <td>{$row['aadhaar_name']}</td>
                        <td>{$row['aadhaar_dob']}</td>
                        <td>{$row['father_or_husband']}</td>
                        <td>{$row['marital_status']}</td>
                        <td>{$row['aadhaar_number']}</td>
                        <td>{$row['mobile_number']}</td>
                        <td>{$row['account_holder']}</td>
                        <td>{$row['account_number']}</td>
                        <td>{$row['ifsc_code']}</td>
                        <td>{$row['branch_name']}</td>
                        <td>{$row['experience']}</td>
                        <td>{$row['department']}</td>
                        <td>
                            <form method='post' action='download_employee_pdf.php' target='_blank' class='pdf-form'>
                                <input type='hidden' name='emp_id' value='{$row['emp_id']}'>
                                <button type='submit' class='pdf-btn'>PDF</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='23' style='text-align:center;'>No employee details found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
