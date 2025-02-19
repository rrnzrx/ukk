<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/logo" href="/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Masuk</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100..900&display=swap');

        body {
            font-family: "Noto Sans", serif;
            font-weight: 600;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-container img {
            width: 80px;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #f5f5f5;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #04692b;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .login-container button:hover {
            background-color: #035223;
        }

        .login-container label {
            justify-content: flex-start;
            align-items: start;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="{{ asset('images/logo.png') }}" alt="logo.png">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan nama lengkap" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan NIS" required>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>

</html>
