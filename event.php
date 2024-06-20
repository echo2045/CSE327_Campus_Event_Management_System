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
            margin: 5px 0;
        }
        .events .event .feedback-btn:hover,
        .events .event .read-feedback-btn:hover,
        .events .event .register-btn:hover {
            background-color: #218838;
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
        <a href="landingpage.php">Home</a>
        <a href="#upcoming">Upcoming Events</a>
        <a href="#past">Past Events</a>
    </div>

    <div class="header">
        <h1>Events</h1>
        <p>Stay updated with our latest and past events</p>
    </div>

    <div class="section events" id="upcoming">
        <h2>Upcoming Events</h2>
        <div class="event">
            <h3>Annual Science Fair</h3>
            <p>Date: June 10, 2024</p>
            <p>Location: Main Auditorium</p>
            <p>Description: Join us for the annual science fair where students showcase their projects and innovations. It's a day of learning and discovery for all.</p>
            <button class="register-btn">Register</button>
        </div>
        <div class="event">
            <h3>Music Concert</h3>
            <p>Date: June 15, 2024</p>
            <p>Location: Open Grounds</p>
            <p>Description: Enjoy a night of spectacular performances by various bands and solo artists from our university. Don't miss out on this musical extravaganza!</p>
            <button class="register-btn">Register</button>
        </div>
        <div class="event">
            <h3>Art Exhibition</h3>
            <p>Date: June 20, 2024</p>
            <p>Location: Art Gallery</p>
            <p>Description: Come and appreciate the creative artworks by our talented students at the annual art exhibition. Various forms of art will be on display.</p>
            <button class="register-btn">Register</button>
        </div>
    </div>

    <div class="section events" id="past">
        <h2>Past Events</h2>
        <div class="event">
            <h3>Sports Meet</h3>
            <p>Date: May 5, 2024</p>
            <p>Location: Sports Complex</p>
            <p>Description: A day filled with various sports activities and competitions. Students participated in athletics, football, basketball, and more.</p>
            <button class="feedback-btn" onclick="location.href='givefeedback.html?event=Sports Meet'">Give Feedback</button>
            <button class="read-feedback-btn" onclick="location.href='readfeedback.html?event=Sports Meet'">Read Feedback</button>
        </div>
        <div class="event">
            <h3>Drama Festival</h3>
            <p>Date: April 20, 2024</p>
            <p>Location: University Theater</p>
            <p>Description: An evening of dramatic performances by the university's drama club. Several plays and skits were performed showcasing the acting talent of our students.</p>
            <button class="feedback-btn" onclick="location.href='givefeedback.html?event=Drama Festival'">Give Feedback</button>
            <button class="read-feedback-btn" onclick="location.href='readfeedback.html?event=Drama Festival'">Read Feedback</button>
        </div>
        <div class="event">
            <h3>Tech Symposium</h3>
            <p>Date: March 15, 2024</p>
            <p>Location: Conference Hall</p>
            <p>Description: A symposium on the latest advancements in technology. Various speakers from the tech industry shared their insights and experiences.</p>
            <button class="feedback-btn" onclick="location.href='givefeedback.html?event=Tech Symposium'">Give Feedback</button>
            <button class="read-feedback-btn" onclick="location.href='readfeedback.html?event=Tech Symposium'">Read Feedback</button>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 University Event Management. All rights reserved.</p>
    </div>
</body>
</html>
