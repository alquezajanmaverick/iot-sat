<?php
date_default_timezone_set('Asia/Manila');
require '../db/dbconn.php';


// Check if POST request contains binary data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the raw POST data (fingerprint image)
    $imageData = file_get_contents("php://input");
    $insertQuery = "INSERT INTO fp_sample (fpvalue) VALUES ('$imageData')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "FINGERPRINT CAPTURED";
    }
    // Ensure data was received
    // if ($imageData) {
    //     // Prepare and bind the SQL statement to insert the image data
    //     $stmt = $conn->prepare("INSERT INTO fingerprint_data (image) VALUES (?)");
    //     $stmt->bind_param("b", $imageData);  // 'b' is for blob (binary data)

    //     // Execute the query
    //     if ($stmt->execute()) {
    //         echo "Fingerprint image uploaded successfully.";
    //     } else {
    //         echo "Error: " . $stmt->error;
    //     }

    //     // Close the prepared statement
    //     $stmt->close();
    // } else {
    //     echo "Error: No image data received.";
    // }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
