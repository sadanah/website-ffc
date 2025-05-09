<?php

#database connection
$conn = mysqli_connect("localhost", "root", "", "db_ffc");

#check database connection
if($conn->connect_error){
    die("Connection error" . $conn->connect_error);
}

#check whether request method is post
if($_SERVER['REQUEST_METHOD']=='POST'){

    $fName = $_POST["fName"] ?? "fName error";
    $lName = $_POST["lName"] ?? "lName error";
    $email = $_POST["email"] ?? "email error";
    $message = $_POST["message"] ?? "message error";

    #Use prepared statement (prevents SQL errors & injection)
    $stmt = $conn->prepare("INSERT INTO contact_us (fName, lName, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fName, $lName, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Thank you for contacting us $fName!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Please Try Again!'); window.location.href='contact.html';</script>";
    }

    $stmt->close();
}

$conn->close();

?>
