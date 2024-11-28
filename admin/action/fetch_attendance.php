<?php
require '../../db/dbconn.php';

$last_fetch_id = isset($_GET['last_fetch_id']) ? $_GET['last_fetch_id'] : null;
$date = isset($_GET['date']) ? $_GET['date'] : null;
$week = isset($_GET['week']) ? $_GET['week'] : null;
$month = isset($_GET['month']) ? $_GET['month'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;
$dateRange = null;


function getWeekStartEndDate($weekNumber, $month, $year) {
    // Ensure that the week number is valid
    if ($weekNumber < 1 || $weekNumber > 52) {
        return "Invalid week number. Please provide a value between 1 and 52.";
    }
    
    // Ensure that the month is valid
    if ($month < 1 || $month > 12) {
        return "Invalid month. Please provide a value between 1 and 12.";
    }

    // First, get the first day of the given month
    $firstDayOfMonth = strtotime("$year-$month-01");
    
    // Find the weekday of the first day of the month
    $firstWeekday = date('w', $firstDayOfMonth);

    // Adjust for the first Monday of the month
    $firstMonday = strtotime("next monday", $firstDayOfMonth);
    
    // Calculate the start date of the desired week number
    $startDate = strtotime("+".($weekNumber - 1)." weeks", $firstMonday);

    // Calculate the end date (6 days after the start date)
    $endDate = strtotime("+6 days", $startDate);

    // Format the dates
    $startDateFormatted = date('Y-m-d', $startDate);
    $endDateFormatted = date('Y-m-d', $endDate);

    return ['start_date' => $startDateFormatted, 'end_date' => $endDateFormatted];
}

if($week != null && $month != null && $year != null){
    $dateRange = getWeekStartEndDate($week, $month, $year);
}

// Query to fetch data newer than last fetch ID, ordered by attendance_id in descending order
$display_attendance = "
    SELECT att.attendance_id, 
           CONCAT(ay.year_start, ' - ', ay.year_end, ' ', 
                  CASE ay.semester
                      WHEN 1 THEN '1st Sem'
                      WHEN 2 THEN '2nd Sem'
                      WHEN 3 THEN 'Mid Year'
                      ELSE 'Unknown Sem'
                  END) AS acadyearsem, 
           att.uid, 
           att.date_time, 
           att.type, 
           CONCAT(st.last_name, ' ', st.first_name) AS name
    FROM attendance_tbl att
    INNER JOIN student_tbl st ON att.student_id = st.student_id
    INNER JOIN acad_yr_tbl ay ON att.acad_id = ay.acad_id
    WHERE att.attendance_id > '$last_fetch_id'"; 
$display_attendance .= $date != null ? " AND DATE(date_time) = '$date'" : "";
// $display_attendance .= $week != null && $month != null && $year != null ? "AND (DATE(date_time) BETWEEN '".$dateRange['start_date']."' AND '".$dateRange['end_date']."')" : "";

$display_attendance .= " ORDER BY att.attendance_id DESC";

$result = mysqli_query($conn, $display_attendance);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);


