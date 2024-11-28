<?php
// Assuming you have a database connection established
require '../../db/dbconn.php';

// Check if the department_code or department_name already exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_code = strtoupper($_POST['department_code']);
    $department_name = strtoupper($_POST['department_name']);

    // Query to check if department_code or department_name already exists
    $query = "SELECT * FROM department_tbl WHERE department_code = '$department_code' OR department_name = '$department_name'";
    $result = mysqli_query($conn, $query);

    // Prepare response object
    $response = array();

    // If a row is fetched, department_code or department_name already exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $exists = array(
            'department_code' => ($row['department_code'] == $department_code),
            'department_name' => ($row['department_name'] == $department_name)
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
