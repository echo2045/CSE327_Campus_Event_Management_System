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
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Organizer Page</h2>

        <!-- Display upcoming events -->
        <div class="event-list">
            <h3>Upcoming Events</h3>
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

        <!-- Display registrations awaiting approval -->
        <div class="registration-list">
            <h3>Registrations Awaiting Approval</h3>
            <?php
            // Database connection
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
            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query feedback for events
            $query_feedback = "SELECT events.title AS event_title, faculty.name AS faculty_name, feedback
                               FROM feedback
                               INNER JOIN events ON feedback.event_id = events.id
                               INNER JOIN faculty ON feedback.faculty_id = faculty.id
                               ORDER BY feedback.submission_date DESC";
            $result_feedback = $conn->query($query_feedback);

            if ($result_feedback->num_rows > 0) {
                while ($row = $result_feedback->fetch_assoc()) {
                    echo '<div class="feedback-item">';
                    echo '<h4>' . htmlspecialchars($row['event_title']) . '</h4>';
                    echo '<p><strong>Faculty:</strong> ' . htmlspecialchars($row['faculty_name']) . '</p>';
                    echo '<p><strong>Feedback:</strong><br>' . htmlspecialchars($row['feedback']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No feedback received.</p>';
            }

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


