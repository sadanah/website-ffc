<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "db_ffc");

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Fetch contacts
$contacts = [];
$contact_sql = "SELECT * FROM contact_us ORDER BY conID DESC";
$result = $conn->query($contact_sql);
while ($row = $result->fetch_assoc()) {
    $contacts[] = $row;
}

// Fetch registrations
$registrations = [];
$reg_sql = "SELECT * FROM registrations ORDER BY regID DESC";
$result = $conn->query($reg_sql);
while ($row = $result->fetch_assoc()) {
    $registrations[] = $row;
}

echo json_encode([
    'contacts' => $contacts,
    'registrations' => $registrations
]);

$conn->close();
?>