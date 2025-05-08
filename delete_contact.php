<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "db_ffc");

// Check database connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if (isset($_POST['conID'])) {
    $conID = $_POST['conID'];

    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM contact_us WHERE conID = ?");
    $stmt->bind_param("i", $conID);

    if ($stmt->execute()) {
        // Optional: redirect back to user list
        header("Location: index.html?msg=deleted");
        exit();
    } else {
        echo "Error deleting user.";
    }

    $stmt->close();
} else {
    echo "No conID received.";
}

$conn->close();
?>
