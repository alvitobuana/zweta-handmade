<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Zweta Handmade</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="wrapper">

    <!-- TITLE -->
    <div class="title">
        <h1>Zweta Handmade</h1>
        <p>Login Calon Pembeli</p>
    </div>

    <!-- CARD -->
    <div class="card">

        <div class="form-group">
            <label>Email</label>
            <input type="email" placeholder="Masukkan email" id="email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" placeholder="Masukkan password" id="password">
        </div>

        <button class="btn" onclick="window.location.href='/'">Login</button>

        <p class="link">
            Belum punya akun? <a href="{{ url('/register') }}">Register</a>
        </p>

    </div>

</div>

<!-- <script src="{{ asset('js/auth.js') }}"></script> -->

</body>
</html>