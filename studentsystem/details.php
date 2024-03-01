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

        // Display the logintime data as a multiline text field
        echo "Login Time: <br>";
        echo "<form action=\"\" method=\"POST\">";
        echo "<textarea name='logintime' id='logintime' rows='4' cols='50'>" . $row["logintime"] . "</textarea><br>";

        // Add a submit button to save the login time
        echo "<input type='submit' name='submit' value='Submit'><br>";
        echo "</form>";

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
        $logintime = $_POST['logintime'];

        // Update the login time in the database table
        $updateSql = "UPDATE students SET logintime='$logintime' WHERE username='$username'";
        if ($conn->query($updateSql) === TRUE) {
            echo "<p>Login time saved successfully!</p>";
        } else {
            echo "Error updating login time: " . $conn->error;
        }
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<script>
    function handlePuckData(data) {
        var logintimeField = document.getElementById('logintime');
        logintimeField.value = data;
    }

    function fetchDataFromPuck() {
        // Make an AJAX request to the server to fetch data from the Puck.js device
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    handlePuckData(xhr.responseText);
                }
            }
        };
        xhr.open('GET', 'puck_data.php', true);
        xhr.send();
    }

    // Call fetchDataFromPuck() when the page is loaded
    window.onload = function() {
        fetchDataFromPuck();
    };
</script>

<form action="logout.php" method="POST">
    <button type="submit">Logout</button>
</form>