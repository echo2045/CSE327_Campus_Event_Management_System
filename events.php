<?php
$servername = "localhost";
$username = "root";
$password = "";  // Change this if you have a password
$dbname = "campus_event_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Current date
$current_date = date('Y-m-d');

// Fetch upcoming events (events with date in the future)
$today_sql="SELECT * FROM events WHERE  Date='$current_date' ORDER BY Date ASC";
$today=$conn->query($today_sql);

$upcoming_sql = "SELECT * FROM events WHERE Date > '$current_date' ORDER BY Date ASC";

$upcoming = $conn->query($upcoming_sql);

// Fetch past events (events with date in the past)
$past_sql = "SELECT * FROM events WHERE Date < '$current_date' ORDER BY Date DESC";
$past = $conn->query($past_sql);

function formatEventDate($date) {
    $dateTime = new DateTime($date);
    return $dateTime->format('F j,Y');
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management - Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .header {
            text-align: center;
            padding: 50px;
            background: #1abc9c;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 50px;
        }
        .section {
            padding: 20px;
        }
        .events .event {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .events .event .register-btn,
        .events .event .feedback-btn,
        .events .event .read-feedback-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px 4px;
        }
        .events .event .feedback-btn:hover,
        .events .event .read-feedback-btn:hover,
        .events .event .register-btn:hover {
            background-color: #218838;
        }
        .search input[type=text] {
            float: right;
  padding: 6px;
  border: none;
  margin-top: 8px;
  margin-right: 16px;
  font-size: 17px;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="events.php">Home</a>
        <a href="upcoming.php">Upcoming Events</a>
        <a href="#past">Past Events</a>
    </div>

    <div class="header">
        <h1>Events</h1>
        <p>Stay updated with our latest and past events</p>
        <div class="search"> 
      
        <form method="get" action="search.php">
        <input type="text" name="search" placeholder="Search" value="">
      
    </form>
        </div>
    </div>
    <div class="section events" id="today">
<h2>Events for today</h2>
<?php
    if ($today ->num_rows > 0) {
    while($row = $today ->fetch_assoc()) {
        echo "<div class='event'>";
        echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
        echo "<p>Date: " . formatEventDate($row["Date"]) . "</p>";
        echo "<p>Location: " . htmlspecialchars($row["Location"]) . "</p>";
        echo "<p>Description: " . htmlspecialchars($row["Description"]) . "</p>";
        echo "<button class='register-btn' onclick=\"location.href='eventRegister.php'\">Register</button>";
        echo "</div>";
    }
}else {
            echo "<p>No events for today.</p>";
        }
        ?>
    </div>

    <div class="section events" id="upcoming">
    <h2>Upcoming Events</h2>
        <?php
        if ($upcoming ->num_rows > 0) {
            while($row = $upcoming ->fetch_assoc()) {
                echo "<div class='event'>";
                echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
                echo "<p>Date: " . formatEventDate($row["Date"]) . "</p>";
                echo "<p>Location: " . htmlspecialchars($row["Location"]) . "</p>";
                echo "<p>Description: " . htmlspecialchars($row["Description"]) . "</p>";
                echo "<button class='register-btn' onclick=\"location.href='eventRegister.php'\">Register</button>";
                echo "</div>";
            }
        } else {
            echo "<p>No upcoming events.</p>";
        }
        ?>
    </div>
    <div class="section events" id="past">
        <h2>Past Events</h2>
        <?php
        if ($past->num_rows > 0) {
            while($row = $past->fetch_assoc()) {
                echo "<div class='event'>";
                echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
                echo "<p>Date: " . formatEventDate($row["Date"]) . "</p>";
                echo "<p>Location: " . htmlspecialchars($row["Location"]) . "</p>";
                echo "<p>Description: " . htmlspecialchars($row["Description"]) . "</p>";
                echo "<button class='feedback-btn' onclick=\"location.href='givefeedback.html?event=" . urlencode($row["title"]) . "'\">Give Feedback</button>";
                echo "<button class='read-feedback-btn' onclick=\"location.href='readfeedback.html?event=" . urlencode($row["title"]) . "'\">Read Feedback</button>";
                echo "</div>";
            }
        } else {
            echo "<p>No past events.</p>";
        }
        $conn->close();
        ?>
<?php
    // Database connection
    $con = mysqli_connect("localhost", "root", "", "campus_event_management_system");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Search and display events
    if (isset($_GET['search'])) {
        $filtervalues = mysqli_real_escape_string($con, $_GET['search']);
        $query = "SELECT * FROM events WHERE title LIKE '%$filtervalues%'";
        echo "Query: " . $query . "<br>";  // Debugging output

        $query_run = mysqli_query($con, $query);

        if (!$query_run) {
            die("Query failed: " . mysqli_error($con));
        }

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $item) {
                ?>
                <div class="section events" id="past">
                    <div class="event">
                        <h2><?php echo htmlspecialchars($item['title']); ?></h2>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($item['Date']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($item['Location']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($item['Description']); ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No events found.";
        }
    }
    // Close the database connection
    mysqli_close($con);
    ?>





    
    </div>

    <div class="footer">
        <p>&copy; 2024 University Event Management. All rights reserved.</p>
    </div>
</body>
</html>