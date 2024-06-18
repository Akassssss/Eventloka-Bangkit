<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - Event Details</title>
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
        .detail {
            margin-bottom: 20px;
        }
        .detail p {
            color: #748cab;
            margin-bottom: 10px;
            line-height: 1.6;
        }
        .detail strong {
            color: #1d2d44;
        }
        form label {
            display: block;
            font-weight: bold;
            margin: 10px 0 5px;
            color: #1d2d44;
        }
        form input[type="text"],
        form input[type="date"],
        form input[type="number"],
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
            font-family: 'Poppins', sans-serif;
        }
        .buttons {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .buttons button {
            padding: 10px 20px;
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
            <h2>{{$data->name}}</h2>
            <div class="detail">
                <p><strong>Date:</strong> {{$data->date}}</p>
                <p><strong>Location:</strong> {{$data->location}}</p>
                <p><strong>Scale:</strong> {{$data->scale}} Persons</p>
                <p><strong>Description:</strong></p>
                <p>{{$data->description}}</p>
                <p><strong>Category:</strong> {{$data->category}}</p>
                <p><strong>Theme:</strong> {{$data->theme}}</p>
                <p><strong>Budget:</strong> {{$data->budget}}</p>
                <p><strong>Preferred Fee:</strong> 
                    @switch($data->price)
                        @case(1)
                            < 1 Juta
                            @break
                        @case(2)
                            1 Juta - 5 Juta
                            @break
                        @case(3)
                            5 Juta - 10 Juta
                            @break
                        @case(4)
                            10 Juta - 20 Juta
                            @break
                        @case(5)
                            > 20 Juta
                            @break
                    @endswitch
                </p>
            </div>
            <form action="{{url('/initiator/event/'.$data->id.'/ongoing')}}" method="POST">
                @csrf
                @method('PUT')
                <label for="rate">Rate the Event:</label>
                <input placeholder="{{$data->rate}}" value="{{$data->rate}}" type="number" id="rate" name="rate" min="1" max="5" required>

                <label for="rateForOrg">Rate the Event organizer:</label>
                <input placeholder="{{$data->rateForOrg}}" value="{{$data->rateForOrg}}" type="number" id="rateForOrg" name="rateForOrg" min="1" max="5" required>
    
                <div class="buttons">
                    <button type="submit" >Done</button>
                </div>
            </form>
            
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
