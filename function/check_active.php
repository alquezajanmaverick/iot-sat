<?php
// Database connection parameters
require '../db/dbconn.php';

// Check if deviceName is received from the AJAX request
if(isset($_GET['deviceName'])) {
    $deviceName = mysqli_real_escape_string($conn, $_GET['deviceName']);

    // Fetch data from device_tbl based on deviceName
    $sql = "SELECT * FROM device_tbl WHERE device_code = '$deviceName'";
    $result = $conn->query($sql);

    // Check if any data is returned
    if ($result->num_rows > 0) {
        // Array to store device data
        $deviceData = array();

        // Fetch each row of data
        while($row = $result->fetch_assoc()) {
            // Add row to device data array
            $deviceData[] = array(
                'device_id' => $row['device_id'],
                'device_code' => $row['device_code'],
                'last_active' => $row['last_active']
            );
        }

        // Encode device data array to JSON format and output
        echo json_encode($deviceData);
    } else {
        // No data found for the specified device
        echo json_encode(array("error" => "No devices found for the specified device name."));
    }
} else {
    // deviceName parameter is missing in the AJAX request
    echo json_encode(array("error" => "Device name parameter is missing."));
}

// Close database connection
$conn->close();
?>
