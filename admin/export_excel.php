<?php
require_once '../config/db.php';

// Headers to force download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=employee_records.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Get all employee records
$query = "SELECT * FROM employee_details ORDER BY id DESC";
$result = mysqli_query($conn, $query);

echo "<table border='1'>";
echo "<tr>";
// Print column headers
$columns = mysqli_fetch_fields($result);
foreach ($columns as $col) {
    echo "<th>" . $col->name . "</th>";
}
echo "</tr>";

// Print rows
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>" . htmlspecialchars($value) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
