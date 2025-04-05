<?php

#database connection
$conn = mysqli_connect("localhost", "root", "", "db_ffc");

#check database connection
if($conn->connect_error){
    die("Connection error" .$conn->connect_error);
}

#check whether request method is post
if($_SERVER['REQUEST_METHOD']=='POST'){

    $fName = $_POST["fName"] ?? "fName error";
    $lName = $_POST["lName"] ?? "lName error";
    $email = $_POST["email"] ?? "email error";
    $phoneNo = $_POST["phoneNo"] ?? "phoneNo error";
    $program = $_POST["program"] ?? "program error";
    $duration = $_POST["duration"] ?? "duration error";

    #insert data to table
    $sql = "insert into registrations(fName, lName, email, phoneNo, program, duration) values('$fName', '$lName', '$email', '$phoneNo', '$program', '$duration')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thank you for contacting us $fName!'); window.location.href='contact.html';</script>";
    } else {
        echo "Try again!";
    }
}

$conn->close();

?>