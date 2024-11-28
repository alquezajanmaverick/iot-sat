<?php
require '../../db/dbconn.php';

// Check if student_id is provided and is numeric
if (isset($_POST['class_id']) && is_numeric($_POST['class_id'])) {
    // Sanitize the input to prevent SQL injection
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);

    // Update the student's information
    $sql = "UPDATE class_tbl SET 
            program_id='$program_id', 
            year='$year',
            section='$section'
            WHERE class_id='$class_id'";

    if (mysqli_query($conn, $sql)) {
        // Student information updated successfully
        $response = array(
            "status" => "success",
            "message" => "Class updated successfully.",
        );
    } else {
        // Error updating student information
        $response = array(
            "status" => "error",
            "message" => "Failed to update class.",
        );
    }
} else {
    // If student_id is missing or not numeric
    $response = array(
        "status" => "error",
        "message" => "Invalid class ID.",
    );
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
?>
