<?php
// Ensure you have the organizer ID from somewhere, e.g., from a login process or another form of authentication
$organizer_id = 1; // Replace with the actual organizer ID, or retrieve it from your application's logic

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

// Query to get organizer information (assuming 'users' table contains organizer information)
$query_organizer_info = "SELECT * FROM users WHERE id = ?";
$stmt_organizer_info = $conn->prepare($query_organizer_info);
$stmt_organizer_info->bind_param("i", $organizer_id);
$stmt_organizer_info->execute();
$result_organizer_info = $stmt_organizer_info->get_result();

if ($result_organizer_info->num_rows > 0) {
    $organizer = $result_organizer_info->fetch_assoc();
} else {
    die("Organizer not found.");
}

$stmt_organizer_info->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .event-list {
            margin-bottom: 20px;
        }
        .event-item {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .registration-list {
            margin-top: 20px;
        }
        .registration-item {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .feedback-list {
            margin-top: 20px;
        }
        .feedback-item {
            background-color: #e0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .create-event-form {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .create-event-form .form-group {
            margin-bottom: 10px;
        }
        .create-event-form label {
            display: block;
            margin-bottom: 5px;
        }
        .create-event-form input[type="text"], 
        .create-event-form textarea, 
        .create-event-form input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .create-event-form input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;    
            font-size: 16px;
            cursor: pointer;
        }
        .create-event-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .attendees-list {
            margin-top: 30px;
        }
        .attendees-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .attendees-list th, .attendees-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .attendees-list th {
            background-color: #f2f2f2;
        }
        .logout-btn {
            text-align: right;
            margin-bottom: 10px;
        }
        .logout-btn button {
            padding: 8px 16px;
            background-color: #dc3545;
            border: none;
            color: white;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }
        .logout-btn button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout-btn">
            <button onclick="location.href='logout.php';">Logout</button>
        </div>

        <h2>Welcome to Organizer Page</h2>

        <!-- Display organizer information -->
        <div class="organizer-info">
            <h3>Organizer Information</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($organizer['full_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($organizer['email']); ?></p>
            <!-- Add more organizer information as needed -->
        </div>

        <!-- Display upcoming events -->
        <div class="event-list">
            <h3>Upcoming Events</h3>
            <?php
            // Query upcoming events
            $query_events = "SELECT * FROM events WHERE date_time > NOW() ORDER BY date_time";
            $result_events = $conn->query($query_events);

            if ($result_events->num_rows > 0) {
                while ($row = $result_events->fetch_assoc()) {
                    echo '<div class="event-item">';
                    echo '<h4>' . htmlspecialchars($row['title']) . '</h4>';
                    echo '<p><strong>Date:</strong> ' . htmlspecialchars($row['date_time']) . '</p>';
                    echo '<p><strong>Description:</strong><br>' . htmlspecialchars($row['description']) . '</p>';
                    if ($row['approved'] == 0) {
                        echo '<p><strong>Status:</strong> Pending Approval</p>';
                    } else {
                        echo '<p><strong>Status:</strong> Approved</p>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<p>No upcoming events.</p>';
            }

            // Close connection
            $conn->close();
            ?>
        </div>

        <!-- Track Attendees Section -->
        <section class="attendees-list">
            <h3>Event Attendees</h3>
            <table>
                <tr>
                    <th>Event Title</th>
                    <th>Attendee Name</th>
                    <th>Email</th>
                    <th>Type</th>
                </tr>
                <?php
                // Create connection (reuse existing $servername, $username, $password, $dbname)
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch event attendees
                $query_attendees = "SELECT e.title AS event_title, u.name AS attendee_name, u.email AS attendee_email, u.type AS attendee_type
                                   FROM event_registrations er
                                   INNER JOIN events e ON er.event_id = e.id
                                   INNER JOIN users u ON er.user_id = u.id";
                $result_attendees = $conn->query($query_attendees);

                // Display attendees
                if ($result_attendees->num_rows > 0) {
                    while ($row = $result_attendees->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['event_title']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['attendee_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['attendee_email']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['attendee_type']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No attendees found.</td></tr>';
                }

                // Close connection
                $conn->close();
                ?>
            </table>
        </section>

        <!-- Display registrations awaiting approval -->
        <div class="registration-list">
            <h3>Registrations Awaiting Approval</h3>
            <?php
            // Create connection (reuse existing $servername, $username, $password, $dbname)
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query registrations for approval
            $query_registrations = "SELECT events.title AS event_title, students.name AS student_name
                                   FROM event_registrations
                                   INNER JOIN events ON event_registrations.event_id = events.id
                                   INNER JOIN students ON event_registrations.user_id = students.id
                                   WHERE events.date_time > NOW() AND event_registrations.approved = 0
                                   ORDER BY events.date_time";
            $result_registrations = $conn->query($query_registrations);

            if ($result_registrations->num_rows > 0) {
                while ($row = $result_registrations->fetch_assoc()) {
                    echo '<div class="registration-item">';
                    echo '<h4>' . htmlspecialchars($row['event_title']) . '</h4>';
                    echo '<p><strong>Student:</strong> ' . htmlspecialchars($row['student_name']) . '</p>';
                    echo '<form action="approve_registration.php" method="post">';
                    echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
                    echo '<input type="hidden" name="student_id" value="' . $row['student_id'] . '">';
                    echo '<input type="submit" value="Approve">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No registrations awaiting approval.</p>';
            }

            // Close connection
            $conn->close();
            ?>
        </div>

        <!-- Display feedback received -->
        <div class="feedback-list">
            <h3>Feedback Received</h3>
            <?php
            // Create connection (reuse existing $servername, $username, $password, $dbname)
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve feedback from both student and faculty tables
            $query_student_feedback = "SELECT s.event_id, e.title AS event_title, s.feedback, 'Student' AS user_type
                                       FROM student_feedback s
                                       INNER JOIN events e ON s.event_id = e.id
                                       ORDER BY s.event_id DESC";

            $query_faculty_feedback = "SELECT f.event_id, e.title AS event_title, f.feedback, 'Faculty' AS user_type
                                       FROM faculty_feedback f
                                       INNER JOIN events e ON f.event_id = e.id
                                       ORDER BY f.event_id DESC";

            // Execute queries and fetch results
            $result_student_feedback = $conn->query($query_student_feedback);
            $result_faculty_feedback = $conn->query($query_faculty_feedback);

            // Function to display feedback
            function displayFeedback($result, $userType) {
                if ($result->num_rows > 0) {
                    echo "<h3>$userType Feedback</h3>";
                    echo '<table border="1" cellpadding="5" cellspacing="0">';
                    echo '<tr><th>Event ID</th><th>Event Title</th><th>Feedback</th></tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['event_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['event_title']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['feedback']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo "<p>No $userType feedback available.</p>";
                }
                echo '<br>';
            }

            // Display feedback for students
            displayFeedback($result_student_feedback, 'Student');

            // Display feedback for faculty
            displayFeedback($result_faculty_feedback, 'Faculty');

            // Close connection
            $conn->close();
            ?>
        </div>

        <!-- Create Event Form -->
        <div class="create-event-form">
            <h3>Create New Event</h3>
            <form action="submit_event.php" method="post">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="date_time">Date and Time:</label>
                    <input type="datetime-local" id="date_time" name="date_time" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit for Approval">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
