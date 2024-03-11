<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$course = $_POST['course'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Additional validation goes here...


// Generate student ID
$student_id = substr($course, 0, 3) . mt_rand(100, 999) . date("Y");

// Insert data into database
$sql = "INSERT INTO students (username, password, firstname, lastname, course, student_id, logintime)
        VALUES ('$student_id', '$password', '$firstname', '$lastname', '$course', '$student_id', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Account created successfully. Student ID: $student_id'); window.location='../frontend/dashboard.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
