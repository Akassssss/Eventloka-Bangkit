<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - Initiator Profile</title>
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
        .profile-detail p {
            color: #748cab;
            margin-bottom: 10px;
            line-height: 1.6;
        }
        .profile-detail strong {
            color: #1d2d44;
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
    @include('components.sidebarorg')
    <div class="main-content">
        <div class="container">
            <h2>Event Organizer Profile</h2>
            <div class="profile-detail">
                <p><strong>Name:</strong> {{$organizer->name}}</p>
                <p><strong>Email:</strong> {{auth()->user()->email}}</p>
                <p><strong>Hire:</strong> {{$organizer->hired}}</p>
                <p><strong>Rate:</strong> {{$organizer->rate == 0 ? '-' : $organizer->rate}}</p>
                <p><strong>Location:</strong> {{$organizer->location == 0 ? '-' : $organizer->location}}</p>
                <p><strong>Usual Category:</strong> {{$organizer->categorySpecialist == 0 ? '-' : $organizer->categorySpecialist}}</p>
                <p><strong>Usual Scale:</strong> {{$organizer->scaleSpecialist == 0 ? '-' : $organizer->scaleSpecialist}}</p>
                <p><strong>Experience in Years:</strong> {{$organizer->experience == 0 ? '-' : $organizer->experience}}</p>
                <p><strong>About:</strong></p>
                <p>{{$organizer->services}}</p>
            </div>
            <div class="buttons">
                <button type="button" onclick="window.location.href='{{url('/organizer/editprofile')}}'">Edit Profile</button>
                <button type="button" onclick="window.location.href='{{url('/logout')}}'">Logout</button>
            </div>
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
