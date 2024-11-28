<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $first_name = strtoupper(mysqli_real_escape_string($conn, $_POST['first_name']));
    $mid_name = strtoupper(mysqli_real_escape_string($conn, $_POST['mid_name']));
    $last_name = strtoupper(mysqli_real_escape_string($conn, $_POST['last_name']));
    $ext_name = strtoupper(mysqli_real_escape_string($conn, $_POST['ext_name']));
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert new event
    $sql = "INSERT INTO admin_tbl (first_name, middle_name, last_name, ext_name, email)
            VALUES ('$first_name', '$mid_name', '$last_name', '$ext_name', '$email')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // SQL query to insert new event
        $sql2 = "INSERT INTO user_tbl (email, password, usertype)
                 VALUES ('$email','$hashed_password', 1)";
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
}

// Close the database connection
mysqli_close($conn);
?>
