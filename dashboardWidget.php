<?php
// Connect to your database
$conn = new mysqli("localhost", "root", "", "student_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count students by course
$sql = "SELECT course, COUNT(*) as student_count FROM students GROUP BY course";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Dashboard</title>
</head>
<body>
    <h2>Course Dashboard</h2>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<p>Course: " . $row["course"]. " - Students Signed In: " . $row["student_count"]. "</p>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</body>
</html>
