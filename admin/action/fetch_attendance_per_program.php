<?php
// Database connection
require '../../db/dbconn.php';

// Fetch the default academic year
$query = "SELECT acad_id FROM acad_yr_tbl WHERE is_default = 1 AND deleted = 0";
$result = $conn->query($query);
$defaultAcadYear = $result->fetch_assoc()['acad_id'];

// Fetch attendance counts per program
$query = "
    SELECT p.program_code, COUNT(a.attendance_id) as total_attendance
    FROM attendance_tbl a
    INNER JOIN student_tbl s ON a.student_id = s.student_id
    WHERE a.acad_id = $defaultAcadYear AND a.deleted = 0
    GROUP BY p.program_id
";

$result = $conn->query($query);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'program_code' => $row['program_code'],
            'total_attendance' => (int)$row['total_attendance']
        ];
    }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close the database connection
$conn->close();
?>
