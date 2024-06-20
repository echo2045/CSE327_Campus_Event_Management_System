<?php
// Database connection parameters
$servername = "localhost";
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password
$dbname = "327"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$title = $_POST['title'];
$description = $_POST['description'];
$date_time = $_POST['date_time'];

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO events (title, description, date_time) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $description, $date_time);

// Execute SQL statement
if ($stmt->execute()) {
    echo "Event created successfully.";
} else {
    echo "Error creating event: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
