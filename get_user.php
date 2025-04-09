<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "db_ffc");

// Check database connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

// Get regID from the query parameter (passed via GET)
$regID = isset($_GET['regID']) ? $_GET['regID'] : null;

// Validate regID
if ($regID && is_numeric($regID)) {
    // Prepare SQL statement to fetch user data based on regID
    $sql = "SELECT * FROM registrations WHERE regID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $regID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode($user); // Return user data as JSON
        } else {
            echo json_encode(['error' => 'User not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
} else {
    echo json_encode(['error' => 'Invalid or missing user ID']);
}

$conn->close();
?>