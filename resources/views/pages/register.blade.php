<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Zweta Handmade</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="wrapper">

    <div class="title">
        <h1>Zweta Handmade</h1>
        <p>Buat akun calon pembeli</p>
    </div>

    <div class="card">

        <h2 class="form-title">Register User</h2>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" placeholder="Masukkan nama lengkap" id="name">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" placeholder="Masukkan email" id="email">
        </div>

        <div class="form-group">
            <label>Nomor WhatsApp</label>
            <input type="text" placeholder="Masukkan nomor WhatsApp" id="wa">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" placeholder="Buat password" id="password">
        </div>

        <button class="btn" onclick="register()">Daftar</button>

        <p class="link">
            Sudah punya akun? <a href="{{ url('/login') }}">Login</a>
        </p>

    </div>

</div>

<!-- <script src="{{ asset('js/auth.js') }}"></script> -->

</body>
</html>