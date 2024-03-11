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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_id = $_POST["selected_id"];

    // SQL query to retrieve data based on selected ID
    $sql = "SELECT * FROM students WHERE id = $selected_id";

    $result = $conn->query($sql);

    // Check if there are any rows in the result set
    if ($result->num_rows > 0) {
        // Output data of the selected row
        $row = $result->fetch_assoc();
        $selected_id = $row["id"];
        $username = $row["username"];
        $password = $row["password"];
        // Add other fields as needed
    } else {
        $error_message = "No results found for the selected ID.";
    }
}

// Fetch all IDs from the database
$id_query = "SELECT id FROM students";
$id_result = $conn->query($id_query);

$id_options = "";
if ($id_result->num_rows > 0) {
    while ($id_row = $id_result->fetch_assoc()) {
        $id_options .= "<option value='" . $id_row["id"] . "'>" . $id_row["id"] . "</option>";
    }
}

// Close the database connection
$conn->close();
?>
