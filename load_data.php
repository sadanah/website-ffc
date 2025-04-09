<?php
// load_data.php
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "db_ffc");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch contacts and registrations
$contactQuery = "SELECT * FROM contact_us";
$regQuery = "SELECT * FROM registrations";
$contacts = mysqli_query($conn, $contactQuery);
$registrations = mysqli_query($conn, $regQuery);

$contactData = [];
$registrationData = [];

while ($contact = mysqli_fetch_assoc($contacts)) {
    $contactData[] = $contact;
}

while ($registration = mysqli_fetch_assoc($registrations)) {
    $registrationData[] = $registration;
}

echo json_encode([
    'contacts' => $contactData,
    'registrations' => $registrationData
]);

mysqli_close($conn);
?>
