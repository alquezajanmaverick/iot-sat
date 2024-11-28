<?php
// Assuming you have a database connection established
require '../../db/dbconn.php';

// Check if the department_code or department_name already exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Query to check if uid already exists
    $query = "SELECT * FROM student_tbl WHERE uid = '$uid'";
    $result = mysqli_query($conn, $query);

    // Query to check if email already exists
    $query2 = "SELECT st.*, ut.email as user_email
                FROM user_tbl ut
                LEFT JOIN student_tbl st ON st.email = ut.email
                WHERE ut.email = '$email'";
    $result2 = mysqli_query($conn, $query2);

    // Prepare response object
    $response = array();

    // If a row is fetched, uid already exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $uidExists = true;
    } else {
        $uidExists = false;
    }

    // If a row is fetched, email already exists
    if (mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        $emailExists = true;
    } else {
        $emailExists = false;
    }

    if ($emailExists || $uidExists) {
        // Store existence status in the response
        $response['exists'] = array(
            'uid' => $uidExists,
            'email' => $emailExists
        );
    }else{
        // If no row is fetched, department doesn't exist
        $response['exists'] = false;
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If request method is not POST, return error response
    $response = array('error' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
