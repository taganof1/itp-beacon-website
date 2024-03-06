<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

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

$username = $_SESSION['username'];

$sql = "SELECT * FROM students WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Student ID: " . $row["student_id"] . "<br>";
        echo "First Name: " . $row["firstname"] . "<br>";
        echo "Last Name: " . $row["lastname"] . "<br>";
        echo "Course: " . $row["course"] . "<br>";

        // Set the timezone to UK
        date_default_timezone_set('Europe/London');
        
        // Display the logintime data as a multiline text field
        echo "Login Time: <br>";
        
        // Change date and time format to UK format
        $logintime = empty($row["logintime"]) ? "" : date("d/m/Y H:i:s", strtotime($row["logintime"]));
        echo "<textarea name='logintime' id='logintime' rows='4' cols='50' disabled>" . $logintime . "</textarea><br>";
        
        // Add a submit button to save the login time if it's not already set
        if (empty($row["logintime"])) {
            echo "<form action=\"\" method=\"POST\">";
            echo "<input type='submit' name='submit' value='Check In'><br>";
            echo "</form>";
        }

        // Retrieve the subject values from the ENUM column
        $subjectSql = "SHOW COLUMNS FROM students LIKE 'subject'";
        $subjectResult = $conn->query($subjectSql);

        if ($subjectResult->num_rows > 0) {
            $subjectRow = $subjectResult->fetch_assoc();
            $enumValues = explode(",", str_replace("'", "", substr($subjectRow['Type'], 5, (strlen($subjectRow['Type']) - 6))));

            echo "Subject: ";
            echo "<select>";
            
            // Add options to the dropdown
            foreach ($enumValues as $value) {
                echo "<option value='$value'>$value</option>";
            }

            echo "</select><br>";
        }
    }

    // Handle form submission
    if (isset($_POST['submit'])) {
        // Check if it's a new day or if login time is not set
        if (empty($row["logintime"])) {
            $logintime = date("Y-m-d H:i:s");
            
            // Update the login time in the database table
            $updateSql = "UPDATE students SET logintime='$logintime' WHERE username='$username'";

            if ($conn->query($updateSql) === TRUE) {
                echo "<p>Login time saved successfully!</p>";
            } else {
                echo "Error updating login time: " . $conn->error;
            }
        } else {
            echo "<p>Login time already set for today.</p>";
        }
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<script>
// Disable form resubmission on refresh
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<form action="logout.php" method="POST">
    <!-- Your logout form -->
</form>
