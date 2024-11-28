<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $program_code = strtoupper(mysqli_real_escape_string($conn, $_POST['program_code']));
    $program_name = strtoupper(mysqli_real_escape_string($conn, $_POST['program_name']));
    $department_id = strtoupper(mysqli_real_escape_string($conn, $_POST['department_id']));

    // SQL query to insert new event
    $sql = "INSERT INTO program_tbl (program_code, program_name, department_id)
            VALUES ('$program_code', '$program_name', '$department_id')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error';
    }
}

// Close the database connection
mysqli_close($conn);
?>
