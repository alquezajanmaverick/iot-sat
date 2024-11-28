<?php

$apiKey = '2dadc4525e1fa0d424ef5bcf249a9b0c'; // Replace with your actual API key
$apiUrl = 'https://semaphore.co/api/v4/messages';

// Function to send SMS
function sendSMS($apiKey, $apiUrl, $contact, $message) {
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    $parameters = [
        'apikey' => $apiKey,
        'number' => $contact,
        'message' => $message,
        'sendername' => 'PCBsat'
    ];

    curl_setopt_array($ch, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => http_build_query($parameters),
        CURLOPT_RETURNTRANSFER => true,
    ]);

    // Execute cURL request
    $output = curl_exec($ch);
    curl_close($ch);
    
    return $output;
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'card_id' parameter is set
    if (isset($_POST["card_id"])) {
        // Retrieve the RFID card ID from the POST data
        $cardID = $_POST["card_id"];

        // Sanitize the input to prevent SQL injection
        $sanitizedCardID = filter_var($cardID, FILTER_SANITIZE_STRING);

        // Connect to the database
        require '../db/dbconn.php';

        // Fetch default academic year and semester
        $acadQuery = "SELECT acad_id, CONCAT(year_start, ' - ', year_end, ' (', 
                        CASE semester
                            WHEN 1 THEN '1st Sem'
                            WHEN 2 THEN '2nd Sem'
                            WHEN 3 THEN 'Mid Year'
                            ELSE 'Unknown Sem'
                        END, ')') AS acadyearsem 
                      FROM acad_yr_tbl 
                      WHERE is_default = 1 LIMIT 1";
        $acadResult = $conn->query($acadQuery);

        if ($acadResult->num_rows > 0) {
            $acadRow = $acadResult->fetch_assoc();
            $acadID = $acadRow["acad_id"];

            // Check if the RFID card ID exists in the student_tbl table
            $checkQuery = "SELECT student_id, first_name, last_name, contact, guardian_contact 
                           FROM student_tbl 
                           WHERE uid = '$sanitizedCardID' AND deleted = 0";
            $checkResult = $conn->query($checkQuery);

            if ($checkResult->num_rows > 0) {
                // RFID card ID exists in the student_tbl table
                $row = $checkResult->fetch_assoc();
                $studentID = $row["student_id"];
                $firstName = $row["first_name"];
                $lastName = $row["last_name"];
                $studentContact = $row["contact"];
                $parentContact = $row["guardian_contact"];

                // Check if the student already has an entry for today
                $latestEntryQuery = "SELECT type FROM attendance_tbl 
                                     WHERE student_id = '$studentID' 
                                     AND DATE(date_time) = CURDATE() 
                                     ORDER BY date_time DESC LIMIT 1";
                $latestEntryResult = $conn->query($latestEntryQuery);

                if ($latestEntryResult->num_rows > 0) {
                    $latestEntry = $latestEntryResult->fetch_assoc();
                    $latestType = $latestEntry["type"];

                    if ($latestType == 1) {
                        // Student already checked IN today, cannot check IN again
                        $response = array(
                            "status" => "error",
                            "message" => "Student has already checked IN today. Please check OUT first.",
                            "lcdMessage" => "ALREADY IN!",
                            "firstName" => $firstName,
                            "lastName" => $lastName
                        );
                        echo json_encode($response);
                    } else {
                        // Insert the RFID card ID and student ID into the attendance_tbl table as IN
                        $insertQuery = "INSERT INTO attendance_tbl (uid, student_id, acad_id, type, date_time) 
                                        VALUES ('$sanitizedCardID', $studentID, $acadID, 1, NOW())";
                        if ($conn->query($insertQuery) === TRUE) {
                            // Successfully inserted IN record into the attendance_tbl table
                            $message = "Hi $firstName $lastName. You have successfully checked IN at school.";
                            sendSMS($apiKey, $apiUrl, $studentContact, $message);
                            sendSMS($apiKey, $apiUrl, $parentContact, $message);

                            $response = array(
                                "status" => "success",
                                "message" => "RFID card ID belongs to $firstName $lastName. IN attendance recorded successfully.",
                                "lcdMessage" => "RECORDED!",
                                "firstName" => $firstName,
                                "lastName" => $lastName
                            );
                            echo json_encode($response);
                        } else {
                            // Error inserting IN record into the attendance_tbl table
                            $response = array(
                                "status" => "error",
                                "message" => "Error recording IN attendance: " . $conn->error,
                                "lcdMessage" => "SQL ERROR!"
                            );
                            echo json_encode($response);
                        }
                    }
                } else {
                    // No entry found for today, student can check IN
                    $insertQuery = "INSERT INTO attendance_tbl (uid, student_id, acad_id, type, date_time) 
                                    VALUES ('$sanitizedCardID', $studentID, $acadID, 1, NOW())";
                    if ($conn->query($insertQuery) === TRUE) {
                        // Successfully inserted IN record into the attendance_tbl table
                        $message = "Hi $firstName $lastName. You have successfully checked IN at school.";
                        sendSMS($apiKey, $apiUrl, $studentContact, $message);
                        sendSMS($apiKey, $apiUrl, $parentContact, $message);

                        $response = array(
                            "status" => "success",
                            "message" => "RFID card ID belongs to $firstName $lastName. IN attendance recorded successfully.",
                            "lcdMessage" => "RECORDED!",
                            "firstName" => $firstName,
                            "lastName" => $lastName
                        );
                        echo json_encode($response);
                    } else {
                        // Error inserting IN record into the attendance_tbl table
                        $response = array(
                            "status" => "error",
                            "message" => "Error recording IN attendance: " . $conn->error,
                            "lcdMessage" => "SQL ERROR!"
                        );
                        echo json_encode($response);
                    }
                }
            } else {
                // RFID card ID does not exist in the student_tbl table
                $response = array(
                    "status" => "error",
                    "message" => "RFID card ID does not exist in the student_tbl table",
                    "lcdMessage" => "UNKNOWN CARD!"
                );
                echo json_encode($response);
            }
        } else {
            // No default academic year and semester found
            $response = array(
                "status" => "error",
                "message" => "Default academic year and semester not found",
                "lcdMessage" => "ACAD ERROR!"
            );
            echo json_encode($response);
        }

        // Close database connection
        $conn->close();
    } else {
        // 'card_id' parameter is missing
        $response = array(
            "status" => "error",
            "message" => "'card_id' parameter is missing",
            "lcdMessage" => "PARAMETER ERROR!"
        );
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array(
        "status" => "error",
        "message" => "Only POST requests are allowed",
        "lcdMessage" => "POST ERROR!"
    );
    echo json_encode($response);
}

?>
