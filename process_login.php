<?php
// Start the session for user login tracking
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "db_ffc");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the submitted username and password
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Query to check the credentials in the database
$query = "SELECT * FROM registrations WHERE username = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
        // ✅ Password matches - store everything needed in session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['regID'] = $user['regID']; // ✅ Corrected from $row to $user
        
        echo json_encode([
            'success' => true,
            'username' => $user['username'],
            'role' => $user['role']
        ]);
    } else {
        // Password doesn't match
        echo json_encode(['success' => false, 'message' => 'Invalid password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
}

$stmt->close();
$conn->close();
?>
