<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error_message = "";
$selected_id = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_id = $_POST["selected_id"];

    $sql = "SELECT * FROM students WHERE id = $selected_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
        $password = $row["password"];
        // Add other fields as needed
    } else {
        $error_message = "No results found for the selected ID.";
    }
}

$id_query = "SELECT id FROM students";
$id_result = $conn->query($id_query);

$id_options = "";
if ($id_result->num_rows > 0) {
    while ($id_row = $id_result->fetch_assoc()) {
        $id_options .= "<option value='" . $id_row["id"] . "'>" . $id_row["id"] . "</option>";
    }
}

$conn->close();
?>

<h2>Student Information</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="selected_id">Select Student ID:</label>
    <select name="selected_id">
        <?php echo $id_options; ?>
    </select>
    <input type="submit" value="Submit">
</form>

<?php
if ($error_message !== "") {
    echo "<p style='color: red;'>$error_message</p>";
} else {
    echo "<h3>Student Information:</h3>";
    echo "<p><strong>ID:</strong> $selected_id</p>";
    echo "<p><strong>Username:</strong> $username</p>";
    echo "<p><strong>Password:</strong> $password</p>";
    // Add other fields as needed
}
?>

</body>
</html>
