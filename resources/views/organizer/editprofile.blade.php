<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - Edit Organizer Profile</title>
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
            color: #1d2d44;
            display: block;
            margin-bottom: 5px;
        }
        .profile-detail input, .profile-detail textarea, .profile-detail select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #748cab;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .profile-detail select {
            appearance: none;
            background-repeat: no-repeat;
            background-position: right 10px center;
        }
        .profile-detail .input-group {
            display: flex;
            align-items: center;
        }
        .profile-detail .input-group input {
            flex: 1;
        }
        .profile-detail .input-group span {
            margin-left: 10px;
            color: #748cab;
        }
        .profile-detail textarea {
            resize: vertical;
            height: 100px;
        }
        .buttons {
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
    @include('components.sidebarOrg')
    <div class="main-content">
        <div class="container">
            <h2>Edit Event Organizer Profile</h2>
            <form action="{{url('/organizer/editprofile')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="profile-detail">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{$organizer->name}}" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{auth()->user()->email}}" disabled>

                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="{{$organizer->location}}" required>

                    <label for="categorySpecialist">Usual Category:</label>
                    <select id="categorySpecialist" name="categorySpecialist" required>
                        <option value="charity" {{$organizer->categorySpecialist == 'charity' ? 'selected' : ''}}>Charity</option>
                        <option value="competition" {{$organizer->categorySpecialist == 'competition' ? 'selected' : ''}}>Competition</option>
                        <option value="gathering" {{$organizer->categorySpecialist == 'gathering' ? 'selected' : ''}}>Gathering</option>
                        <option value="festival" {{$organizer->categorySpecialist == 'festival' ? 'selected' : ''}}>Festival</option>
                        <option value="party" {{$organizer->categorySpecialist == 'party' ? 'selected' : ''}}>Party</option>
                        <option value="seminar" {{$organizer->categorySpecialist == 'seminar' ? 'selected' : ''}}>Seminar</option>
                        <option value="sport" {{$organizer->categorySpecialist == 'sport' ? 'selected' : ''}}>Sport</option>
                        <option value="wedding" {{$organizer->categorySpecialist == 'wedding' ? 'selected' : ''}}>Wedding</option>
                    </select>

                    <label for="scaleSpecialist">Usual Scale:</label>
                    <div class="input-group">
                        <input type="number" id="scaleSpecialist" name="scaleSpecialist" value="{{$organizer->scaleSpecialist}}" required>
                        <span>persons</span>
                    </div>

                    <label for="experience">Experience in Years:</label>
                    <input type="number" id="experience" name="experience" value="{{$organizer->experience}}" required>

                    <label for="services">About:</label>
                    <textarea id="services" name="services" required>{{$organizer->services}}</textarea>
                </div>
                <div class="buttons">
                    <button type="submit">Save Changes</button>
                    <button type="button" onclick="window.location.href='{{url('/organizer/profile')}}'">Cancel</button>
                </div>
            </form>
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
