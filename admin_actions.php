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

// Handle add user action
if (isset($_POST['add_user'])) {
    $email = $_POST['email'];

    // Check if the user already exists
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        header("Location: admin_page.php?message=User already exists&status=error");
        exit();
    }

    // Insert the user into the users table
    $insert_query = "INSERT INTO users (email, type) VALUES ('$email', 'student')"; // Default type 'student', adjust as needed
    if ($conn->query($insert_query) === TRUE) {
        header("Location: admin_page.php?message=User added successfully&status=success");
        exit();
    } else {
        header("Location: admin_page.php?message=Error adding user: " . $conn->error . "&status=error");
        exit();
    }
}

// Handle delete user action
if (isset($_POST['delete_user'])) {
    $email = $_POST['email'];

    // Delete the user from the users table
    $delete_query = "DELETE FROM users WHERE email = '$email'";
    if ($conn->query($delete_query) === TRUE) {
        header("Location: admin_page.php?message=User deleted successfully&status=success");
        exit();
    } else {
        header("Location: admin_page.php?message=Error deleting user: " . $conn->error . "&status=error");
        exit();
    }
}

// Close connection
$conn->close();
?>









