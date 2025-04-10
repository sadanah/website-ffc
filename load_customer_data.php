<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "db_ffc");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statement for user details
$userQuery = "SELECT fName, lName, email, phoneNo, program, duration FROM registrations WHERE username = ?";
$userStmt = $conn->prepare($userQuery);
$userStmt->bind_param("s", $_SESSION['username']);
$userStmt->execute();
$userResult = $userStmt->get_result();

// Use prepared statement for schedule
$schedQuery = "SELECT date, time, trainer, info 
               FROM schedule 
               WHERE program IN (
                   SELECT program FROM registrations WHERE username = ?
               )";
$schedStmt = $conn->prepare($schedQuery);
$schedStmt->bind_param("s", $_SESSION['username']);
$schedStmt->execute();
$scheduleResult = $schedStmt->get_result();

// Fetch user details
$userDetails = [];
while ($user = mysqli_fetch_assoc($userResult)) {
    $userDetails[] = $user;
}

// Fetch schedule details
$scheduleDetails = [];
while ($schedule = mysqli_fetch_assoc($scheduleResult)) {
    $scheduleDetails[] = $schedule;
}

echo json_encode([
    'users' => $userDetails,
    'schedule' => $scheduleDetails
]);

$conn->close();
?>
