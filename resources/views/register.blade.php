<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLoka - Register</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0ebd8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #1d2d44;
            margin-bottom: 20px;
            font-family: 'Fredoka One', cursive;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #1d2d44;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #748cab;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #748cab;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .show-password {
            margin-left: 5px;
            cursor: pointer;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #1d2d44;
            color: #f0ebd8;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #3e5c76;
        }
        button:focus {
            outline: none;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #1d2d44;
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
    <div class="container">
        <h2>Register to EventLoka</h2>
        <form action="{{url('register')}}" method="post">
            @csrf
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="user_type">Register As:</label>
            <select id="role" name="role" required>
                <option value="initiator">Initiator</option>
                <option value="organizer">Organizer</option>
            </select>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Register</button>
        </form>
        <div class="footer">
            Already have an account? <a href="login">Login</a>
        </div>
    </div>

</body>
</html>
