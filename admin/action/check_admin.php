<?php
// Assuming you have a database connection established
require '../../db/dbconn.php';

// Check if the department_code or department_name already exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Query to check if department_code or department_name already exists
    $query = "SELECT att.*, ut.email as user_email
                FROM user_tbl ut
                LEFT JOIN admin_tbl att ON att.email = ut.email
                WHERE ut.email = '$email'";
    $result = mysqli_query($conn, $query);

    // Prepare response object
    $response = array();

    // If a row is fetched, department_code or department_name already exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $exists = array(
            'email' => ($row['user_email'] == $email)
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
