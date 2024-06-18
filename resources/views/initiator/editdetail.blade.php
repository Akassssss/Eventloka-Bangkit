<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
            margin-left: 270px; /* Adjusted for sidebar width */
            padding: 20px;
            background-color: #f0ebd8; /* Match background */
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: left;
        }
        .container h2 {
            color: #1d2d44;
            margin-top: 0;
            font-size: 28px;
            border-bottom: 2px solid #1d2d44;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .profile-detail {
            margin-bottom: 20px;
        }
        .profile-detail label {
            display: block;
            color: #1d2d44;
            margin-bottom: 5px;
        }
        .profile-detail input, .profile-detail textarea, .profile-detail select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .profile-detail textarea {
            resize: vertical;
        }
        .buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .buttons button {
            width: calc(50% - 10px); /* Adjusted width for two buttons with space between */
            padding: 10px;
            background-color: #1d2d44;
            color: #f0ebd8;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .buttons button:hover {
            background-color: #3e5c76;
        }
        .buttons button:focus {
            outline: none;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #748cab;
            font-size: 14px;
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
    @include('components.sidebarinit')
    <div class="main-content">
        <div class="container">
            <h2>Edit Event</h2>
            <form action="{{ url('/initiator/event/' . $data->id . '/edit') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="profile-detail">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $data->name }}" required>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="{{ $data->date }}" required>

                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="{{ $data->location }}" required>

                    <label for="scale">Scale:</label>
                    <input type="number" id="scale" name="scale" value="{{ $data->scale }}" required>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required>{{ $data->description }}</textarea>

                    <label for="category">Category:</label>
                    <input type="text" id="category" name="category" value="{{ $data->category }}" required>

                    <label for="theme">Theme:</label>
                    <input type="text" id="theme" name="theme" value="{{ $data->theme }}" required>

                    <label for="budget">Budget:</label>
                    <input type="number" id="budget" name="budget" value="{{ $data->budget }}" required>

                    <label for="price">Preferred Fee:</label>
                    <select id="price" name="price" required>
                        <option value="1" @if($data->price == 1) selected @endif>&lt; < 1 Juta</option>
                        <option value="2" @if($data->price == 2) selected @endif>1 Juta - 5 Juta</option>
                        <option value="3" @if($data->price == 3) selected @endif>5 Juta - 10 Juta</option>
                        <option value="4" @if($data->price == 4) selected @endif>&gt; 10 Juta - 20 Juta</option>
                        <option value="4" @if($data->price == 5) selected @endif>&gt; > 20 Juta</option>
                    </select>
                </div>
                <div class="buttons">
                    <button type="submit">Save Changes</button>
                    <button type="button" onclick="window.location.href='{{ url('/initiator/event/'.$data->id) }}'">Cancel</button>
                </div>
            </form>
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
