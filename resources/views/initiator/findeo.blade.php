<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - Search Results</title>
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
        .content {
            margin-top: 20px;
        }
        .organizer {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .organizer h2 {
            margin-top: 0;
            color: #1d2d44;
        }
        .organizer p {
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
    @include('components.sidebarinit')
    <div class="main-content">
        <div class="header">
            <h1>Search Results</h1>
        </div>
        <div class="content">
            @forelse ($organizers as $item)
                <div class="organizer">
                    <h2>{{ $item->name }}</h2>
                    <p><strong>Location:</strong> {{ $item->location }}</p>
                    <p><strong>Email:</strong> {{ $item->email }}</p>
                    <p><strong>Description:</strong> {{ $item->services }}</p>
                    <form action="{{ url('/initiator/event/'.$data->id.'/find') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <button type="submit">Choose this Organizer</button>
                    </form>
                    <button type="button" class="view-details-btn">
                        <i class="fas fa-search"></i> View Details
                    </button>
                </div>
                <div class="popup-container">
                    <div class="popup-content">
                        <span class="close-popup">&times;</span>
                        <h2>Details of {{ $item->name }}</h2>
                        <p><strong>Email:</strong> {{ $item->email }}</p>
                        <p><strong>Rating:</strong> {{ $item->rate }}</p>
                        <p><strong>Hired:</strong> {{ $item->hired }}</p>
                        <p><strong>Experience in Years:</strong> {{ $item->experience }}</p>
                        <p><strong>Location:</strong> {{ $item->location }}</p>
                        <p><strong>Specialized Category :</strong> {{ $item->categorySpecialist }}</p>
                        <p><strong>Specialized Scale:</strong> {{ $item->scaleSpecialist }}</p>
                        <p><strong>About:</strong> {{ $item->services }}</p>
                        <!-- Tambahkan informasi detail lainnya sesuai kebutuhan -->
                    </div>
                </div>
            @empty
                <p>No organizers found matching your criteria.</p>
            @endforelse
        </div>
        <div class="footer">
            © 2024 EventLoka. All rights reserved. <a href="#">Privacy Policy</a>
        </div>
    </div>
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
</body>
</html>
