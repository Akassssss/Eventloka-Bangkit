<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - EO Requests</title>
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
            max-width: 800px;
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
        .requests-list {
            list-style-type: none;
            padding: 0;
        }
        .request-item {
            background-color: #f0ebd8;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .request-item h3 {
            margin: 0;
            color: #1d2d44;
        }
        .request-item p {
            margin: 5px 0;
            color: #748cab;
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
            <h2>Requests for {{$data->name}}</h2>
            <ul class="requests-list">
                @foreach ($eo as $item)
                    <li class="request-item">
                        <h3>{{ $item->name }}</h3>
                        <p><strong>Contact:</strong> {{ $item->email }}</p>
                        <div class="actions">
                            <form action="{{url('/initiator/event/'.$data->id.'/request')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="organizer" id="organizer" value="{{$item->id}}">
                                <button type="submit">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            <button type="button">
                                <i class="fas fa-search"></i> View Details
                            </button>
                        </div>
                        {{-- <p><strong>Message:</strong> {{ $request->message }}</p> --}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
