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
        .event-link {
            text-decoration: none;
            color: inherit; /* Optionally inherit the color from parent */
        }

        .event-link:hover {
            /* Optional: Define hover styles */
            text-decoration: none; /* Remove underline on hover */
            color: inherit; /* Optionally inherit the color from parent */
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
        .popup-container {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* max-width: 600px; */
            border-radius: 5px;
            position: relative;
            max-height: 80vh; Maksimum tinggi popup
            overflow-y: auto; /* Aktifkan scrollbar vertikal jika konten lebih panjang */
            
        }

        .close-popup {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-popup:hover,
        .close-popup:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @include('components.sidebarOrg')
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
            <form action="{{url('/organizer/event/'.$data->id.'/request')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="buttons">
                    <button type="submit" >Take</button>
                    <button type="button" class="view-details-btn" >Detail </button>
                </div>
            </form>
            <div class="popup-container">
                <div class="popup-content">
                    <span class="close-popup">&times;</span>
                    <h2>Details of {{ $item->name }}</h2>
                    <p><strong>Rating:</strong> {{ $item->rate }}</p>
                    <p><strong>Hired:</strong> {{ $item->hired }}</p>
                    <p><strong>Location:</strong> {{ $item->location }}</p>
                    <p><strong>About:</strong> {{ $item->services }}</p>
                    <!-- Tambahkan informasi detail lainnya sesuai kebutuhan -->
                </div>
            </div>
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewDetailsBtns = document.querySelectorAll('.view-details-btn');
        const popups = document.querySelectorAll('.popup-container');
        const closeBtns = document.querySelectorAll('.close-popup');

        viewDetailsBtns.forEach((btn, index) => {
            btn.addEventListener('click', function() {
                popups[index].style.display = 'block';
            });
        });

        closeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                btn.closest('.popup-container').style.display = 'none';
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const popups = document.querySelectorAll('.popup-content');

        popups.forEach(popup => {
            // Misalnya, jika tinggi konten melebihi 80% tinggi jendela, atur maksimum tinggi popup
            const windowHeight = window.innerHeight;
            const maxHeight = windowHeight * 0.8; // 80% tinggi jendela

            if (popup.scrollHeight > maxHeight) {
                popup.style.maxHeight = maxHeight + 'px';
                popup.style.overflowY = 'auto';
            }
        });
    });

</script>
</html>
