<?php
# Database connection
$conn = mysqli_connect("localhost", "root", "", "db_ffc");

# Check database connection
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

# Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Sanitize user inputs
    $fName = mysqli_real_escape_string($conn, $_POST["addFName"] ?? "fName error");
    $lName = mysqli_real_escape_string($conn, $_POST["addLName"] ?? "lName error");
    $email = mysqli_real_escape_string($conn, $_POST["addEmail"] ?? "email error");
    $phoneNo = mysqli_real_escape_string($conn, $_POST["addPhoneNo"] ?? "phoneNo error");
    $username = mysqli_real_escape_string($conn, $_POST["addUsername"] ?? "username error");
    $password = $_POST["addPassword"] ?? 'password error';
    $conPassword = $_POST["conPassword"] ?? 'confirmPassword error';
    $program = mysqli_real_escape_string($conn, $_POST["addProgram"] ?? "NULL");
    $duration = mysqli_real_escape_string($conn, $_POST["addDuration"] ?? "NULL");
    $role = mysqli_real_escape_string($conn, $_POST["addRole"] ?? "role error");

    # Password hashing
    if ($password == $conPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    } else {
        echo "<script>alert('Password mismatch!'); window.location.href='registration.html';</script>";
        exit;
    }

    # Check if username already exists using prepared statement
    $checkUsernameSql = "SELECT * FROM registrations WHERE username = ?";
    $stmt = $conn->prepare($checkUsernameSql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Username exists, show error
        echo "<script>alert('Username already taken! Please choose a different username.'); window.location.href='registration.html';</script>";
        exit;
    }

    # Insert data into the registrations table
    $insertSql = "INSERT INTO registrations (fName, lName, email, phoneNo, username, password, program, duration, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("sssssssss", $fName, $lName, $email, $phoneNo, $username, $hashedPassword, $program, $duration, $role);
    
    if ($stmt->execute()) {
        echo "<script>alert('Thank you for joining us, $fName!'); window.location.href='registration.html';</script>";
    } else {
        echo "<script>alert('An error occurred while registering. Please try again.'); window.location.href='registration.html';</script>";
    }
}

$conn->close();
?>
