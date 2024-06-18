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
        .event-link {
            text-decoration: none;
            color: inherit; /* Optionally inherit the color from parent */
        }

        .event-link:hover {
            /* Optional: Define hover styles */
            text-decoration: none; /* Remove underline on hover */
            color: inherit; /* Optionally inherit the color from parent */
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
        .a{
            style
        }
    </style>
</head>
<body>
    @include('components.sidebarorg')
    <div class="main-content">
        
        {{-- <div class="content">
            @if ($reaching->isNotEmpty())
                <h1>Waiting EO Response</h1>
                @foreach ($reaching as $item)
                    <a href="{{url('/initiator/event/'.$item->id)}}" class="event-link">
                        <div class="event">
                            <h2>{{$item->name}}</h2>
                            <p> {{$item->description}}</p>
                        </div>
                    </a>
                @endforeach
            @endif --}}
        {{-- </div> --}}
        {{-- <div class="content">
            @if ($response->isNotEmpty())
                <h1>Waiting Your Response</h1>
                @foreach ($response as $item)
                    <a href="{{url('/initiator/event/'.$item->id)}}" class="event-link">
                        <div class="event">
                            <h2>{{$item->name}}</h2>
                            <p>{{$item->description}}</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div> --}}
        <div class="content">
            @if ($request->isNotEmpty())
                <h1>Waiting You Response</h1>
                @foreach ($request as $item)
                    <a href="{{url('/organizer/event/'.$item->id.'/request')}}" class="event-link">
                        <div class="event">
                            <h2>{{$item->name}}</h2>
                            <p> {{$item->description}}</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="content">
            @if ($ongoing->isNotEmpty())
                <h1>Ongoing</h1>
                @foreach ($ongoing as $item)
                    <a href="{{url('/organizer/event/'.$item->id.'/ongoing')}}" class="event-link">
                        <div class="event">
                            <h2>{{$item->name}}</h2>
                            <p> {{$item->description}}</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="content">
            @if ($done->isNotEmpty())
                <h1>Done</h1>
                @foreach ($done as $item)
                    <a href="{{url('/initiator/event/'.$item->id.'/done')}}" class="event-link">
                        <div class="event">
                            <h2>{{$item->name}}</h2>
                            <p> {{$item->description}}</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
</html>