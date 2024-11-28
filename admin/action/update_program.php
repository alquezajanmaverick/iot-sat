<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if event_id is provided and is numeric
if (isset($_POST['program_id']) && is_numeric($_POST['program_id'])) {
    // Sanitize the input to prevent SQL injection
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    $program_code = strtoupper(mysqli_real_escape_string($conn, $_POST['program_code']));
    $program_name = strtoupper(mysqli_real_escape_string($conn, $_POST['program_name']));
    $department_id = mysqli_real_escape_string($conn, $_POST['department_id']);


    // SQL query to update the event
    $sql = "UPDATE program_tbl SET 
            program_code='$program_code', 
            program_name='$program_name',
            department_id='$department_id'
            WHERE program_id='$program_id'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error';
    }
} else {
    // If event_id is not provided or is not numeric, return error
    echo 'error';
}

// Close the database connection
mysqli_close($conn);
?>
