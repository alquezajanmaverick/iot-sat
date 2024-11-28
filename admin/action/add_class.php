<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);

    // SQL query to insert new event
    $sql = "INSERT INTO class_tbl (program_id, year, section)
            VALUES ('$program_id', '$year', '$section')";

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
