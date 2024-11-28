<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if event_id is provided and is numeric
if (isset($_POST['admin_id']) && is_numeric($_POST['admin_id'])) {
    // Sanitize the input to prevent SQL injection
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    // SQL query to update the 'deleted' flag
    $sql = "UPDATE admin_tbl SET deleted=1 WHERE admin_id='$admin_id'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {

        // SQL query to update the 'deleted' flag
        $sql2 = "UPDATE user_tbl SET deleted=1 WHERE user_id='$user_id'";
        if (mysqli_query($conn, $sql2)) {
            // If the query is successful, return success
            echo 'success';
        }else{
            // If the query fails, return error
            echo 'error';
        }

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
