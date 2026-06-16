<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kontak - Zweta Handmade</title>

    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">Zweta Handmade</div>

    <nav>
        <a href="/home">Home</a>
        <a href="/katalog">Katalog</a>
        <a href="/custom">Custom</a>
        <a href="/tracking">Tracking</a>
        <a class="active" href="/Kontak">Kontak</a>
    </nav>

    <div class="nav-right">
    <input placeholder="Search product...">

    <a href="/login" class="btn-login">Login</a>

    <!-- PROFILE -->
    <a href="/profile" class="profile-icon">
        👤
    </a>
</div>
</header>

<!-- TITLE -->
<div class="header">
    <h1>Hubungi Kami</h1>
    <p>Hubungi Zweta Handmade untuk konsultasi pesanan custom, katalog produk, dan informasi pembayaran.</p>
</div>

<!-- CONTENT -->
<section class="contact-wrapper">

    <!-- LEFT -->
    <div class="card contact-card">

        <div class="item">
            <h4>WhatsApp</h4>
            <p>0812-3456-7890</p>
        </div>

        <div class="item">
            <h4>Email</h4>
            <p>zwetahandmade@gmail.com</p>
        </div>

        <div class="item">
            <h4>Instagram</h4>
            <p>@zwetahandmade</p>
        </div>

        <div class="item">
            <h4>Alamat</h4>
            <p>Bekasi, Jawa Barat</p>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="card map-card">
        <div>
            Google Maps / Lokasi Workshop
            <span>Area ini bisa diganti embed maps saat implementasi web.</span>
        </div>
    </div>

</section>

<!-- NOTE -->
<section class="note">
    <div class="note-card">
        <h3>Catatan</h3>
        <p>Untuk pesanan custom, pelanggan dapat mengirim referensi warna/model melalui halaman Custom Order.</p>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div>
        <h3>Zweta Handmade</h3>
        <p>Tas handmade custom dengan sentuhan personal.</p>
    </div>

    <div>
        <h4>Menu</h4>
        <p>Home • Katalog • Custom Order • Tracking • Kontak</p>
    </div>

    <div>
        <h4>Kontak</h4>
        <p>WhatsApp • Instagram • Email</p>
    </div>
</footer>

</body>
</html>