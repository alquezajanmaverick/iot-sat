<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if event_id is provided and is numeric
if (isset($_POST['department_id']) && is_numeric($_POST['department_id'])) {
    // Sanitize the input to prevent SQL injection
    $department_id = mysqli_real_escape_string($conn, $_POST['department_id']);
    $department_code = strtoupper(mysqli_real_escape_string($conn, $_POST['department_code']));
    $department_name = strtoupper(mysqli_real_escape_string($conn, $_POST['department_name']));

    // SQL query to update the event
    $sql = "UPDATE department_tbl SET 
            department_code='$department_code', 
            department_name='$department_name'
            WHERE department_id='$department_id'";

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
