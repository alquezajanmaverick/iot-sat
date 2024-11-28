<?php
// Set timezone to Philippines
date_default_timezone_set('Asia/Manila');

// Database connection parameters
require '../db/dbconn.php';

// Check if ESP32 sent a ping
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ping']) && $_GET['ping'] == 1) {
    // Get device code from the request (assuming it's passed as a query parameter)
    if(isset($_GET['devcode'])) {
        $deviceCode = mysqli_real_escape_string($conn, $_GET['devcode']);

        // Prepare SQL statement to check if device code exists
        $sql = "SELECT * FROM device_tbl WHERE device_code = '$deviceCode'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Device code exists, update last_active column
            $updateSql = "UPDATE device_tbl SET last_active = NOW() WHERE device_code = '$deviceCode'";
            if ($conn->query($updateSql) === TRUE) {
                echo "Device information updated successfully";
            } else {
                echo "Error updating device information: " . $conn->error;
            }
        } else {
            // Device code doesn't exist, insert new row
            $insertSql = "INSERT INTO device_tbl (device_code, last_active, deleted) VALUES ('$deviceCode', NOW(), 0)";
            if ($conn->query($insertSql) === TRUE) {
                echo "New device information inserted successfully";
            } else {
                echo "Error inserting new device information: " . $conn->error;
            }
        }

        // Close database connection
        $conn->close();
    } else {
        echo "Error: Device code not provided";
    }

    // Send response
    exit;
}

// Your existing code for handling other requests
// ...
?>
