<?php
session_start();

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

// Process login
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User authenticated
    $_SESSION['username'] = $username;
    header("Location: details.php");
} else {
    echo "Invalid username or password";
}

$conn->close();
?>
