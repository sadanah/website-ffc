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

// Fetch users and schedule details
$userQuery = "SELECT fName, lName, email, program, duration FROM users";
$schedQuery = "SELECT date, time, trainer, info FROM schedule";

// Execute the queries
$userDetailsResult = mysqli_query($conn, $userQuery);
$scheduleResult = mysqli_query($conn, $schedQuery);

$userDetails = [];
$scheduleDetails = [];

// Fetch user details
while ($user = mysqli_fetch_assoc($userDetailsResult)) {
    $userDetails[] = $user;
}

// Fetch schedule details
while ($schedule = mysqli_fetch_assoc($scheduleResult)) {
    $scheduleDetails[] = $schedule;
}

// Return the data in JSON format
echo json_encode([
    'users' => $userDetails,
    'schedule' => $scheduleDetails
]);

mysqli_close($conn);
?>
