<?php
require '../../db/dbconn.php';

// Query to fetch data newer than last fetch ID, ordered by attendance_id in descending order
$display_attendance = "SELECT MIN(YEAR(`date_time`)) AS 'MINYEAR',MAX(YEAR(`date_time`)) AS 'MAXYEAR' FROM attendance_tbl;";

$result = mysqli_query($conn, $display_attendance);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
