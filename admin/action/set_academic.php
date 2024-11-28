<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if event_id is provided and is numeric
if (isset($_POST['acad_id']) && is_numeric($_POST['acad_id'])) {
    // Sanitize the input to prevent SQL injection
    $acad_id = mysqli_real_escape_string($conn, $_POST['acad_id']);

    // SQL query to update the 'deleted' flag
    $sql = "UPDATE acad_yr_tbl
            SET is_default = 
                CASE
                    WHEN acad_id = '$acad_id' THEN 1
                    ELSE 0
                END
            WHERE is_default = 1 OR acad_id = '$acad_id'";

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
