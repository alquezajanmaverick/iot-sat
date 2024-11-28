<?php
require '../../db/dbconn.php';

// Check if student_id is provided and is numeric
if (isset($_POST['admin_id']) && is_numeric($_POST['admin_id'])) {
    // Sanitize the input to prevent SQL injection
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $first_name = strtoupper(mysqli_real_escape_string($conn, $_POST['first_name']));
    $mid_name = strtoupper(mysqli_real_escape_string($conn, $_POST['mid_name']));
    $last_name = strtoupper(mysqli_real_escape_string($conn, $_POST['last_name']));
    $ext_name = strtoupper(mysqli_real_escape_string($conn, $_POST['ext_name']));
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Update the student's information
    $sql = "UPDATE admin_tbl SET 
            first_name='$first_name',
            middle_name='$mid_name',
            last_name='$last_name',
            ext_name='$ext_name',
            email='$email'
            WHERE admin_id='$admin_id'";

    if (mysqli_query($conn, $sql)) {
        // Student information updated successfully
        $response = array(
            "status" => "success",
            "message" => "Admin updated successfully.",
        );

        // Update user information if password is provided
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql2 = "UPDATE user_tbl SET 
                    email='$email',
                    password='$hashed_password'
                    WHERE user_id='$user_id'";
            if (mysqli_query($conn, $sql2)) {
                $response['message'] .= " Password changed.";
            } else {
                // Error updating password
                $response = array(
                    "status" => "error",
                    "message" => "Failed to update password.",
                );
            }
        }else{
            $sql2 = "UPDATE user_tbl SET 
                    email='$email'
                    WHERE user_id='$user_id'";
            if (mysqli_query($conn, $sql2)) {
                $response['message'] .= " Password not changed.";
            } else {
                // Error updating password
                $response = array(
                    "status" => "error",
                    "message" => "Failed to update admin.",
                );
            }
        }
    } else {
        // Error updating student information
        $response = array(
            "status" => "error",
            "message" => "Failed to update admin.",
        );
    }
} else {
    // If student_id is missing or not numeric
    $response = array(
        "status" => "error",
        "message" => "Invalid admin ID.",
    );
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
?>
