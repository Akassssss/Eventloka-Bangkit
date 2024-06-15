<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - Initiator Dashboard</title>
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
        .event {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .event h2 {
            margin-top: 0;
            color: #1d2d44;
        }
        .event p {
            color: #748cab;
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
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 0%
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #1d2d44;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #748cab;
            border-radius: 3px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        button {
            width: 48%;
            padding: 10px;
            background-color: #1d2d44;
            color: #f0ebd8;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #3e5c76;
        }
        button:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>EventLoka</h2>
        <ul>
            <li><a href="/initiator">Dashboard</a></li>
            <li><a href="#">My Events</a></li>
            <li><a href="/initiator/create">Create Event</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
       <div class="container">
        <h2>Create New Event</h2>
        <form action="create_event_process.php" method="post">
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="conference">Conference</option>
                <option value="workshop">Workshop</option>
                <option value="meetup">Meetup</option>
                <option value="concert">Concert</option>
                <!-- Tambahkan opsi kategori lain sesuai kebutuhan -->
            </select>

            <div class="buttons">
                <button type="submit" name="action" value="post">Post Listing</button>
                <button type="submit" name="action" value="search">Search Organizers</button>
            </div>
        </form>
    </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
</html>