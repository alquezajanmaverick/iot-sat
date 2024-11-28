<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    require '../db/dbconn.php';

    // Function to sanitize input
    function sanitizeInput($input) {
        global $conn;
        return mysqli_real_escape_string($conn, $input);
    }

    // Check if keys exist in $_POST array before accessing them
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitizeInput($_POST['password']) : '';

    // Construct the SQL query
    $sql = "SELECT * FROM user_tbl WHERE email = '$email' AND deleted = 0";

    // Execute the SQL statement
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password matches, user authenticated
            if ($row['usertype'] == 2) {
                // Construct the SQL query
                $sql2 = "SELECT * FROM student_tbl WHERE email = '$email'";
                // Execute the SQL statement
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();
                $_SESSION['full_name'] = $row2['first_name'] . ' ' . $row2['last_name'];
                $_SESSION['student_id'] = $row2['student_id'];
                $_SESSION['user_id'] = $row['user_id'];
            }elseif ($row['usertype'] == 1) {
                // Construct the SQL query
                $sql2 = "SELECT * FROM admin_tbl WHERE email = '$email'";
                // Execute the SQL statement
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();
                $_SESSION['full_name'] = $row2['first_name'] . ' ' . $row2['last_name'];
                $_SESSION['admin_id'] = $row2['admin_id'];
                $_SESSION['user_id'] = $row['user_id'];
            }
            // Set session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['usertype'] = $row['usertype'];
            // Return role value as part of the response
            echo json_encode(['success' => true, 'usertype' => $row['usertype']]);
            exit();
        } else {
            // Password does not match
            echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
            exit();
        }
    } else {
        // User not found
        echo json_encode(['success' => false, 'message' => 'Email does not exist.']);
        exit();
    }

    // Close connection
    $con->close();
}
?>
