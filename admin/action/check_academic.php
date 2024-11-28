<?php
// Assuming you have a database connection established
require '../../db/dbconn.php';

// Check if the year_start or year_end already exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year_start = mysqli_real_escape_string($conn, $_POST['year_start']);
    $year_end = mysqli_real_escape_string($conn, $_POST['year_end']);

    // Query to check if year_start and year_end already exists
    $query = "SELECT * FROM acad_yr_tbl WHERE year_start = '$year_start' AND year_end = '$year_end'";
    $result = mysqli_query($conn, $query);

    // Prepare response object
    $response = array();

    // If a row is fetched, year_start and year_end already exists
    if (mysqli_num_rows($result) > 0) {
        $response['exists'] = true;
    } else {
        // If no row is fetched, the academic year doesn't exist
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
