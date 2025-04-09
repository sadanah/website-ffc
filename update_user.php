<?php
// Enable detailed error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection
$conn = mysqli_connect("localhost", "root", "", "db_ffc");

// Check database connection
if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user inputs
    $regID = isset($_POST['regID']) ? $_POST['regID'] : null;
    $fName = isset($_POST['fName']) ? $_POST['fName'] : '';
    $lName = isset($_POST['lName']) ? $_POST['lName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phoneNo = isset($_POST['phoneNo']) ? $_POST['phoneNo'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $program = isset($_POST['program']) ? $_POST['program'] : '';
    $duration = isset($_POST['duration']) ? $_POST['duration'] : '';

    // Validate regID to ensure it's a valid number
    if (!is_numeric($regID)) {
        echo "<script>alert('Invalid User ID.'); window.location.href='admin_dash.php';</script>";
        exit;
    }

    // Update user data in the registrations table
    $updateSql = "UPDATE registrations SET fName=?, lName=?, email=?, phoneNo=?, username=?, program=?, duration=?, role=? WHERE regID=?";
    if ($stmt = $conn->prepare($updateSql)) {
        $stmt->bind_param("ssssssssi", $fName, $lName, $email, $phoneNo, $username, $program, $duration, $role, $regID);

        // Execute and check if the update is successful
        if ($stmt->execute()) {
            echo "<script>alert('User information updated successfully!'); window.location.href='admin_dash.php';</script>";
        } else {
            echo "<script>alert('Error updating user information. Please try again.'); window.location.href='admin_dash.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Failed to prepare statement.'); window.location.href='admin_dash.php';</script>";
    }
}

$conn->close();
?>
