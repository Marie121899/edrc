<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to eCitizen</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Your existing styles remain here */

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url("{{ asset('img/uni.jpg') }}");
            background-size: cover;
        }

        .card {
            background-color: #fff;
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            opacity: 0.9; /* Set opacity to 80% */
        }

        .select-container {
            margin-top: 20px;
        }

        .button-container {
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .button a {
        color: white;        /* Set text color to white */
        text-decoration: none; /* Remove underline */
        }

        .button.register {
            background-color: #4CAF50; /* Primary button color */
            color: white;
        }

        .button.login {
            background-color: #3498DB; /* Secondary button color */
            color: white;
        }

        /* Flags for select options */
        #language option[value="french"] {
            background-image: url("img/french.png");
            background-size: 20px; /* Adjust the size as needed */
            background-repeat: no-repeat;
            background-position: 5px center;
            padding-left: 30px; /* Ensure space for the flag */
        }

        #language option[value="english"] {
            background-image: url("img/uk.png");
            background-size: 20px; /* Adjust the size as needed */
            background-repeat: no-repeat;
            background-position: 5px center;
            padding-left: 30px; /* Ensure space for the flag */
        }
        .logo {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
            display: block; /* Center the image horizontally */
            margin: 0 auto; /* Center the image horizontally */
        }
    </style>
</head>
<body class="antialiased">
    <div class="container">
        
        <div class="card">
            <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
            <h1>DRC eCitizen</h1>
            <div class="select-container">
                <label for="language">Select Language:</label>
                <select id="language">
                    <option value="english" data-icon="{{ asset('img/uk.png') }}"><img src="{{ asset('img/uk.png') }}" alt="English Flag">English</option>
                    <option value="french" data-icon="{{ asset('img/french.png') }}"><img src="{{ asset('img/french.png') }}" alt="French Flag">French</option>
                </select>
            </div>
            <div class="button-container">
                <button class="button register"> <a href="{{ route('register') }}">Register</a> </button>
                <button class="button login"> <a href="{{ route('login') }}">Login</a> </button>
            </div>
        </div>
    </div>
</body>
</html>
