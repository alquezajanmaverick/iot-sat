<?php
// Assuming you have a database connection established
require '../../db/dbconn.php';

// Check if the department_code or department_name already exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Query to check if department_code or department_name already exists
    $query = "SELECT * FROM student_tbl WHERE uid = '$uid' OR email = '$email'";
    $result = mysqli_query($conn, $query);

    // Prepare response object
    $response = array();

    // If a row is fetched, department_code or department_name already exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $exists = array(
            'email' => ($row['email'] == $email),
            'uid' => ($row['uid'] == $uid)
        );
        $response['exists'] = $exists;
    } else {
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
