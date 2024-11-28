<?php
// Include your database connection file here
require '../../db/dbconn.php';

// Assuming you have sanitized and validated your input data, if not, please do so
$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$old_uid = mysqli_real_escape_string($conn, $_POST['old_uid']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$old_email = mysqli_real_escape_string($conn, $_POST['old_email']);

// Check if the UID exists
$sqlUidCheck = "SELECT COUNT(*) AS uid_count FROM student_tbl WHERE uid = '$uid' AND uid != '$old_uid'";
$resultUidCheck = mysqli_query($conn, $sqlUidCheck);
$rowUidCheck = mysqli_fetch_assoc($resultUidCheck);

// Check if the email exists
$sqlEmailCheck = "SELECT COUNT(*) AS email_count FROM student_tbl WHERE email = '$email' AND email != '$old_email'";
$resultEmailCheck = mysqli_query($conn, $sqlEmailCheck);
$rowEmailCheck = mysqli_fetch_assoc($resultEmailCheck);

// Prepare the JSON response
$response = array(
    'uidExists' => $rowUidCheck['uid_count'] > 0,
    'emailExists' => $rowEmailCheck['email_count'] > 0
);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
