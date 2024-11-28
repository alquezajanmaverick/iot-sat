<?php
// Assuming you have a database connection established
require '../../db/dbconn.php';

// Check if the department_code or department_name already exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $program_id = $_POST['program_id'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    // Query to check if department_code or department_name already exists
    $query = "SELECT * 
              FROM class_tbl 
              WHERE program_id = '$program_id' AND year = '$year' AND section = '$section'
             ";
    $result = mysqli_query($conn, $query);

    // Prepare response object
    $response = array();

    // If a row is fetched, department_code or department_name already exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $class_id = $row['class_id'];
        $exists = array(
            'class_id' => ($row['class_id'] == $class_id)
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
