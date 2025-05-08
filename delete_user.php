<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "db_ffc");

// Check database connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if (isset($_POST['regID'])) {
    $regID = $_POST['regID'];

    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE regID = ?");
    $stmt->bind_param("i", $regID);

    if ($stmt->execute()) {
        // Optional: redirect back to user list
        header("Location: users.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting user.";
    }

    $stmt->close();
} else {
    echo "No regID received.";
}

$conn->close();
?>
