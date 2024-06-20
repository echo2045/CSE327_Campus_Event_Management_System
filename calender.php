<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .calendar {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        .calendar th,
        .calendar td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .calendar th {
            background-color: #f2f2f2;
        }
        .event {
            background-color: #cce5ff;
        }
    </style>
</head>
<body>
    <h1>Event Calendar</h1>
    <table class="calendar">
        <thead>
            <tr>
                <th>Date</th>
                <th>Event</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Sample event data (replace with actual event data retrieval)
            $events = array(
                array("date" => "2024-06-10", "name" => "Annual Science Fair", "location" => "Main Auditorium"),
                array("date" => "2024-06-15", "name" => "Music Concert", "location" => "Open Grounds"),
                array("date" => "2024-06-20", "name" => "Art Exhibition", "location" => "Art Gallery")
            );

            // Loop through events and display in calendar
            foreach ($events as $event) {
                echo "<tr class='event'>";
                echo "<td>{$event['date']}</td>";
                echo "<td>{$event['name']}</td>";
                echo "<td>{$event['location']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
