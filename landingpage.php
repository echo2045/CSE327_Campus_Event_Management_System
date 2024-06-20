<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management - University</title>
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
        .about, .events, .contact {
            margin: 20px 0;
        }
        .events .event {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
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
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="event.php">Events</a>
        <a href="#contact">Contact</a>
        <a href="calender.php">Calender</a>

    </div>

    <div class="header" id="home">
        <h1>North South University Event Management System</h1>
        <p>Manage and Participate in University Events</p>
    </div>

    <div class="section about" id="about">
        <h2>About Us</h2>
        <p>Welcome to our University's event management platform. Here you can find all the upcoming events, register for events, and get involved in various activities organized by our university.</p>
    </div>

    <div class="section events" id="events">
        <h2>Upcoming Events</h2>
        <div class="event">
            <h3>Annual Science Fair</h3>
            <p>Date: June 10, 2024</p>
            <p>Time: 10PM</p>
            <p>Location: Main Auditorium</p>
            <p>Description: Join us for the annual science fair where students showcase their projects and innovations. It's a day of learning and discovery for all.</p>
        </div>
        <div class="event">
            <h3>Music Concert</h3>
            <p>Date: June 15, 2024</p>
            <p>Time: 10PM</p>
            <p>Location: Open Grounds</p>
            <p>Description: Enjoy a night of spectacular performances by various bands and solo artists from our university. Don't miss out on this musical extravaganza!</p>
        </div>
        <div class="event">
            <h3>Art Exhibition</h3>
            <p>Date: June 20, 2024</p>
            <p>Time: 10PM</p>
            <p>Location: Art Gallery</p>
            <p>Description: Come and appreciate the creative artworks by our talented students at the annual art exhibition. Various forms of art will be on display.</p>
        </div>
    </div>

    <div class="section contact" id="contact">
        <h2>Contact Us</h2>
        <p>Email: events@university.edu</p>
        <p>Phone: +123 456 7890</p>
        <p>Address: 123 University Lane, City, Country</p>
    </div>

    <div class="footer">
        <p>&copy; 2024 University Event Management. All rights reserved.</p>
    </div>
</body>
</html>
