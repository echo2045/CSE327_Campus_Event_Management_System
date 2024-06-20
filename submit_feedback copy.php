<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $event_id = $_POST['event_id'];
    $feedback = $_POST['feedback'];

    // Validate if event_id and feedback are provided
    if (empty($event_id) || empty($feedback)) {
        die("Error: Event ID and Feedback are required.");
    }

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

    // Start session to get student_id
    session_start();
    $student_id = $_SESSION['student_id']; // Replace with your actual session variable

    // Insert feedback into the database
    $stmt = $conn->prepare("INSERT INTO feedback (event_id, student_id, feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $event_id, $student_id, $feedback);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect or handle as needed
    die("Error: Form submission method not allowed.");
}
?>
