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
        input[type="number"],
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
        .scale-container {
            display: flex;
            align-items: center;
        }
        .scale-container input[type="number"] {
            width: auto;
            flex: 1;
            margin-right: 10px;
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
    @include('components.sidebarinit')
    <div class="main-content">
       <div class="container">
        <h2>Create New Event</h2>
        <form action="/initiator/create" method="post">
            @csrf
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
            
            <label for="scale">Scale:</label>
            <div class="scale-container">
                <input type="number" id="scale" name="scale" required>
                <span>Persons</span>
            </div>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="conference">Charity</option>
                <option value="competition">Competition</option>
                <option value="Gathering">Gathering</option>
                <option value="Festival">Festival</option>
                <option value="Party">Party</option>
                <option value="Seminar">Seminar</option>
                <option value="Sport">Sport</option>
                <option value="Wedding">Wedding</option>
            </select>

            <label for="theme">Theme:</label>
            <input type="text" id="theme" name="theme" required>

            <label for="budget">Budget:</label>
            <input type="number" id="budget" name="budget" required>
            
            <label for="price">Preferred Fee:</label>
            <select id="price" name="price" required>
                <option value="1"> < 1 Juta</option>
                <option value="2">1 Juta - 5 Juta</option>
                <option value="3">5 Juta - 10 Juta</option>
                <option value="4">10 Juta - 20 Juta</option>
                <option value="5"> > 20 Juta</option>
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
