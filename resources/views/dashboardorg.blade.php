<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - Organizer Dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0ebd8;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #1d2d44;
            color: #f0ebd8;
            position: fixed;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            text-align: center;
            font-family: 'Fredoka One', cursive;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 20px;
        }
        .sidebar ul li a {
            color: #f0ebd8;
            text-decoration: none;
            font-size: 18px;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 20px;
            border-bottom: 2px solid #748cab;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #1d2d44;
        }
        .header button {
            background-color: #1d2d44;
            color: #f0ebd8;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        .header button:hover {
            background-color: #3e5c76;
        }
        .header button:focus {
            outline: none;
        }
        .content {
            margin-top: 20px;
        }
        .section {
            margin-bottom: 40px;
        }
        .section h2 {
            color: #1d2d44;
            margin-bottom: 20px;
        }
        .event {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .event h3 {
            margin-top: 0;
            color: #1d2d44;
        }
        .event p {
            color: #748cab;
        }
        .event button {
            margin-top: 10px;
            background-color: #1d2d44;
            color: #f0ebd8;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }
        .event button:hover {
            background-color: #3e5c76;
        }
        .event button:focus {
            outline: none;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #1d2d44;
        }
        .footer a {
            color: #3e5c76;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>EventLoka</h2>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Available Events</a></li>
            <li><a href="#">My Events</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Organizer Dashboard</h1>
        </div>
        <div class="content">
            <div class="section">
                <h2>Available Events</h2>
                <div class="event">
                    <h3>Event 1</h3>
                    <p>Description of Event 1. This section includes details about the event.</p>
                    <button>Take Event</button>
                </div>
                <div class="event">
                    <h3>Event 2</h3>
                    <p>Description of Event 2. This section includes details about the event.</p>
                    <button>Take Event</button>
                </div>
                <!-- Repeat this block for more available events -->
            </div>
            <div class="section">
                <h2>My Events</h2>
                <div class="event">
                    <h3>My Event 1</h3>
                    <p>Description of My Event 1. This section includes details about the event.</p>
                </div>
                <div class="event">
                    <h3>My Event 2</h3>
                    <p>Description of My Event 2. This section includes details about the event.</p>
                </div>
                <!-- Repeat this block for more events being managed by the organizer -->
            </div>
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
