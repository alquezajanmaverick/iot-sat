<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $department_code = strtoupper(mysqli_real_escape_string($conn, $_POST['department_code']));
    $department_name = strtoupper(mysqli_real_escape_string($conn, $_POST['department_name']));

    // SQL query to insert new event
    $sql = "INSERT INTO department_tbl (department_code, department_name)
            VALUES ('$department_code', '$department_name')";

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
