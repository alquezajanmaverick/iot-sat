<?php
// Include your database connection file here
require '../../db/dbconn.php';

// Assuming you have sanitized and validated your input data, if not, please do so
$email = mysqli_real_escape_string($conn, $_POST['email']);
$admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);
$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

// Check if the UID exists
$sqlUidCheck = "SELECT COUNT(*) AS uid_count FROM admin_tbl WHERE email = '$email' AND admin_id != '$admin_id'";
$resultUidCheck = mysqli_query($conn, $sqlUidCheck);
$rowUidCheck = mysqli_fetch_assoc($resultUidCheck);

// Check if the email exists
$sqlEmailCheck = "SELECT COUNT(*) AS email_count FROM user_tbl WHERE email = '$email' AND user_id != '$user_id'";
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
