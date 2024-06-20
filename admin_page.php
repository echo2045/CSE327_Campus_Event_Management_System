<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .user-actions {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Admin!</h2>

        <!-- User Actions -->
        <div class="user-actions">
            <h3>User Management</h3>
            <form action="admin_actions.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <input type="submit" name="add_user" value="Add User">
                <input type="submit" name="delete_user" value="Delete User">
            </form>
        </div>

        <!-- Event Tracking, Scheduling, and Approval -->
        <div class="event-actions">
            <h3>Event Management</h3>
            <ul>
                <li><a href="track_events.php">Track Events</a></li>
                <li><a href="schedule_events.php">Schedule Events</a></li>
                <li><a href="approve_events.php">Approve Events</a></li>
            </ul>
        </div>

        <!-- Display success or error messages -->
        <?php
        // Check if there are any messages from previous actions
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            $class = ($_GET['status'] == 'success') ? 'success' : 'error';
            echo "<p class='$class'>$message</p>";
        }
        ?>
    </div>
</body>
</html>
