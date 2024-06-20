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
$event_id = $_POST['event_id'];
$student_id = $_POST['student_id']; // This assumes you have a student_id in event_registrations table

// Update event_registrations to mark as approved (set approved = 1)
$stmt = $conn->prepare("UPDATE event_registrations SET approved = 1 WHERE event_id = ? AND user_id = ?");
$stmt->bind_param("ii", $event_id, $student_id);

// Execute SQL statement
if ($stmt->execute()) {
    echo "Registration approved successfully.";
} else {
    echo "Error approving registration: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
