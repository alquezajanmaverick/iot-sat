<?php
// Include your database connection file here
require '../../db/dbconn.php';

// Assuming you have sanitized and validated your input data, if not, please do so
$program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
$year = mysqli_real_escape_string($conn, $_POST['year']);
$section = mysqli_real_escape_string($conn, $_POST['section']);
$class_id = mysqli_real_escape_string($conn, $_POST['class_id']);

// Check if the class exists
$sqlUidCheck = "SELECT COUNT(*) AS class_count FROM class_tbl WHERE program_id = '$program_id' AND year = '$year' AND section = '$section' AND class_id != '$class_id'";
$resultUidCheck = mysqli_query($conn, $sqlUidCheck);
$rowUidCheck = mysqli_fetch_assoc($resultUidCheck);

// Prepare the JSON response
$response = array(
    'classExists' => $rowUidCheck['class_count'] > 0,
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
