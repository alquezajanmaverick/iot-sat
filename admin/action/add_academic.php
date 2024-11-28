<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $year_start = mysqli_real_escape_string($conn, $_POST['year_start']);
    $year_end = mysqli_real_escape_string($conn, $_POST['year_end']);

    // SQL query to insert new events for three semesters
    $sql = "INSERT INTO acad_yr_tbl (year_start, year_end, semester, is_default) VALUES 
            ('$year_start', '$year_end', 1, 0),
            ('$year_start', '$year_end', 2, 0),
            ('$year_start', '$year_end', 3, 0)";

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
