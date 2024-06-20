<?php
session_start();

// Debug: Display all session variables
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>


<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $event_id = $_POST['event_id'];

    // Validate if event_id is provided
    if (empty($event_id)) {
        die("Error: Event ID is required.");
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

    // Start session to get student_id or faculty_id
    session_start();
    $user_id = $_SESSION['student_id']; // Replace with your actual session variable for students
    // Or
    $user_id = $_SESSION['faculty_id']; // Replace with your actual session variable for faculty

    // Check if the user is a student or faculty
    if (isset($_SESSION['student_id'])) {
        $dtype = 'student';
    } elseif (isset($_SESSION['faculty_id'])) {
        $dtype = 'faculty';
    } else {
        die("Error: User session not found.");
    }

    // Check if the user is already registered for the event
    $query_check_registration = "SELECT * FROM event_registrations WHERE event_id = ? AND user_id = ? AND dtype = ?";
    $stmt_check_registration = $conn->prepare($query_check_registration);
    $stmt_check_registration->bind_param("iis", $event_id, $user_id, $dtype);
    $stmt_check_registration->execute();
    $result_check_registration = $stmt_check_registration->get_result();

    if ($result_check_registration->num_rows > 0) {
        die("Error: You are already registered for this event.");
    }

    // Insert registration into the database
    $query_register_event = "INSERT INTO event_registrations (event_id, user_id, dtype) VALUES (?, ?, ?)";
    $stmt_register_event = $conn->prepare($query_register_event);
    $stmt_register_event->bind_param("iis", $event_id, $user_id, $dtype);

    if ($stmt_register_event->execute()) {
        echo "Registration successful. You will receive a notification.";
        // Optionally, send a notification to the user (email, SMS, etc.)
    } else {
        echo "Error: " . $stmt_register_event->error;
    }

    // Close statements and connection
    $stmt_check_registration->close();
    $stmt_register_event->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect or handle as needed
    die("Error: Form submission method not allowed.");
}
?>
