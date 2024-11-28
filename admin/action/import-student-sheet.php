<?php

require '../../vendor/autoload.php';
// Include your database connection file
require '../../db/dbconn.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$duplicateCount = 0;
$entryCount = 0;

function addStudent($sheet,$row,$conn){
    global $entryCount;
    $uid = mysqli_real_escape_string($conn, $sheet->getCell('A' . $row)->getValue());
    $first_name = strtoupper(mysqli_real_escape_string($conn, $sheet->getCell('B' . $row)->getValue()));
    $mid_name = strtoupper(mysqli_real_escape_string($conn, $sheet->getCell('C' . $row)->getValue()));
    $last_name = strtoupper(mysqli_real_escape_string($conn, $sheet->getCell('D' . $row)->getValue()));
    $ext_name = strtoupper(mysqli_real_escape_string($conn, $sheet->getCell('E' . $row)->getValue()));
    $email = mysqli_real_escape_string($conn, $sheet->getCell('F' . $row)->getValue());
    $contact = mysqli_real_escape_string($conn, $sheet->getCell('G' . $row)->getValue());
    $guardian_contact = mysqli_real_escape_string($conn, $sheet->getCell('H' . $row)->getValue());
    $format =strtoupper($sheet->getCell('B' . $row)->getValue() . $sheet->getCell('D' . $row)->getValue());
    $whitespaceRemoved = str_replace(' ', '', $format);
    $password = mysqli_real_escape_string($conn,$whitespaceRemoved);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert new event
    $sql = "INSERT INTO student_tbl (uid, first_name, middle_name, last_name, ext_name, email, contact, guardian_contact)
            VALUES ('$uid', '$first_name', '$mid_name', '$last_name', '$ext_name' , '$email', '$contact', '$guardian_contact')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // SQL query to insert new event
        $sql2 = "INSERT INTO user_tbl (email, password, usertype)
                VALUES ('$email','$hashed_password', 2)";
        if (mysqli_query($conn, $sql2)) {
            $entryCount++;
            // If the query is successful, return success
            // echo 'success';   
        }else{
            // If the query fails, return error
            // echo 'error';
        }
    } else {
        // If the query fails, return error
        // echo 'error';
    }
}

function isExisting($sheet, $row,$conn,){
    global $duplicateCount;
    $uid = mysqli_real_escape_string($conn, $sheet->getCell('A' . $row)->getValue());
    $first_name = strtoupper(mysqli_real_escape_string($conn, $sheet->getCell('B' . $row)->getValue()));
    $last_name = strtoupper(mysqli_real_escape_string($conn, $sheet->getCell('D' . $row)->getValue()));

    $check_student = "SELECT * FROM student_tbl WHERE uid = '$uid' AND LOWER(first_name) = '$first_name' AND LOWER(last_name) = '$last_name'";

    $result = mysqli_query($conn, $check_student);
    $rowCount =  mysqli_num_rows($result);
    $duplicateCount += $rowCount;
    if($rowCount > 0){
        return true;
    }else{
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excelFile'])) {
    $file = $_FILES['excelFile'];

    // Check for file upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        // Return HTTP status 500 for file upload error
        http_response_code(500);
        echo 'Error uploading file.';
        exit;
    }

    // Temporary file path
    $tmpFile = $file['tmp_name'];

    // Validate file type (ensure it's an Excel file)
    $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!in_array($fileType, ['xls', 'xlsx'])) {
        // Return HTTP status 500 for invalid file type
        http_response_code(500);
        echo 'Invalid file type. Please upload an Excel file.';
        exit;
    }

    // Load the Excel file using PhpSpreadsheet
    try {
        $spreadsheet = IOFactory::load($tmpFile);
        // Get the first sheet
        $sheet = $spreadsheet->getActiveSheet();

        $startRow = 2;
        $highestRow = $sheet->getHighestRow(); // Get the last row number
        $highestColumn = $sheet->getHighestColumn(); // Get the last column letter

        // Iterate through the rows starting from the specified row
        for ($row = $startRow; $row <= $highestRow; $row++) {
            if(isExisting($sheet,$row,$conn) == false){
                addStudent($sheet,$row,$conn);
            }
        }
        http_response_code(200);
        echo json_encode(array(
            "duplicateEntries" => $duplicateCount,
            "newEntries" => $entryCount
        ));
    }catch (Exception $e) {
        // Return HTTP status 500 for errors in processing the Excel file
        http_response_code(500);
    }

}else {
    // Return HTTP status 500 if no file is uploaded or if the request method is incorrect
    http_response_code(500);
    echo 'No file uploaded or incorrect request method.';
}