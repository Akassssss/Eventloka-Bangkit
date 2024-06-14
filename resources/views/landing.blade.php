<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - Find and Promote Events</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0ebd8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-image: url('https://images.unsplash.com/photo-1526660411230-8393ad4bbf83');
            background-size: cover;
            background-position: center;
            color: #ffffff;
            padding: 100px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 48px;
            font-weight: 700;
        }
        .header p {
            font-size: 24px;
            margin-top: 20px;
        }
        .features {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .feature {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        .feature:hover {
            transform: translateY(-5px);
        }
        .feature h2 {
            color: #1d2d44;
            margin-bottom: 10px;
        }
        .feature p {
            color: #748cab;
        }
        .cta {
            margin-top: 50px;
            text-align: center;
        }
        .cta a {
            display: inline-block;
            padding: 15px 30px;
            background-color: #1d2d44;
            color: #f0ebd8;
            text-decoration: none;
            border-radius: 30px;
            font-size: 20px;
            transition: background-color 0.3s;
        }
        .cta a:hover {
            background-color: #3e5c76;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Welcome to EventLoka</h1>
            <p>Find and Promote Events Easily</p>
        </header>

        <div class="features">
            <div class="feature">
                <h2>Event Organizers</h2>
                <p>Promote yourself and your events to attract participants.</p>
            </div>
            <div class="feature">
                <h2>Event Initiators</h2>
                <p>Search for event organizers and collaborate to bring your ideas to life.</p>
            </div>
        </div>

        <div class="cta">
            <a href="register">Get Started</a>
        </div>
    </div>
</body>
</html>
