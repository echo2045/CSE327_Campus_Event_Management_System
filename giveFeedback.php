<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group textarea {
            height: 100px;
        }
        .form-group input[type="submit"] {
            width: 100%;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Give Feedback</h2>
        <form action="submit_feedback.php" method="post">
            <div class="form-group">
                <label for="event">Event:</label>
                <input type="text" id="event" name="event" value="Sports Meet" readonly>
            </div>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" name="feedback" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit Feedback">
            </div>
        </form>
    </div>
</body>
</html>
