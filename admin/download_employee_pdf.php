<?php
require_once '../config/db.php';
require('fpdf/fpdf.php'); // Make sure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['emp_id'])) {
    $emp_id = $_POST['emp_id'];

    $query = "SELECT * FROM employee_details WHERE emp_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $emp_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Start output buffering to avoid extra output
        ob_start();

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Employee Details - ' . $row['emp_id'], 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);

        foreach ($row as $key => $value) {
            $label = ucwords(str_replace("_", " ", $key));
            $pdf->Cell(60, 8, $label, 1);
            $pdf->Cell(130, 8, $value, 1);
            $pdf->Ln();
        }

        // Clean output buffer before sending PDF
        ob_end_clean();

        $pdf->Output('D', 'employee_' . $emp_id . '.pdf');
        exit;
    } else {
        echo "Employee not found.";
    }
} else {
    echo "Invalid Request.";
}
?>
