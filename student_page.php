<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Page</title>
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
        .feedback-form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            resize: vertical;
        }
        .form-group input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;    
            font-size: 16px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .registered-events {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to student Page</h2>

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
                    echo '<form action="register_event.php" method="post">';
                    echo '<input type="hidden" name="event_id" value="' . $row['id'] . '">';
                    echo '<input type="submit" value="Register">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No upcoming events.</p>';
            }

            // Close connection
            $conn->close();
            ?>
        </div>

        <!-- Feedback Form -->
        <div class="feedback-form">
            <h3>Submit Feedback</h3>
            <form action="submit_feedback.php" method="post">
                <div class="form-group">
                    <label for="event_id">Event ID:</label>
                    <input type="text" id="event_id" name="event_id" required>
                </div>
                <div class="form-group">
                    <label for="feedback">Feedback:</label>
                    <textarea id="feedback" name="feedback" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit Feedback">
                </div>
            </form>
        </div>

        <!-- Display registered events -->
        <div class="registered-events">
            <h3>Registered Events</h3>
            <?php
            // Database connection (assuming you already have this part)
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query registered events for the faculty
            $query_registered_events = "SELECT events.title, events.date_time, events.description
                                        FROM events
                                        INNER JOIN event_registrations ON events.id = event_registrations.event_id
                                        WHERE event_registrations.user_id = ? AND event_registrations.user_type = 'student'
                                        ORDER BY events.date_time";
            $stmt_registered_events = $conn->prepare($query_registered_events);
            $stmt_registered_events->bind_param("i", $_SESSION['student_id']); // Replace with your actual session variable
            $stmt_registered_events->execute();
            $result_registered_events = $stmt_registered_events->get_result();

            if ($result_registered_events->num_rows > 0) {
                while ($row = $result_registered_events->fetch_assoc()) {
                    echo '<div class="event-item">';
                    echo '<h4>' . htmlspecialchars($row['title']) . '</h4>';
                    echo '<p><strong>Date:</strong> ' . htmlspecialchars($row['date_time']) . '</p>';
                    echo '<p><strong>Description:</strong><br>' . htmlspecialchars($row['description']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No registered events.</p>';
            }

            // Close statement and connection
            $stmt_registered_events->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
