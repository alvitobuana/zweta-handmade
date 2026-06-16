<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk - Zweta Handmade</title>

    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">Zweta Handmade</div>

    <nav>
        <a class="active" href="/home">Home</a>
        <a href="/katalog">Katalog</a>
        <a href="/custom">Custom</a>
        <a href="/tracking">Tracking</a>
        <a href="/kontak">Kontak</a>
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
<div class="page-title">
    <h1>Detail Produk</h1>
</div>

<!-- CONTENT -->
<section class="detail-container">

    <!-- LEFT -->
    <div class="left">

        <div class="main-img" style="background-image: url('{{ asset('images/Foto Tas/Tas totebag/WhatsApp Image 2026-06-15 at 21.35.03.jpeg') }}'); background-size: cover; background-position: center;"></div>

        <div class="thumbs">
            <div style="background-image: url('{{ asset('images/Foto Tas/Tas totebag/WhatsApp Image 2026-06-15 at 21.35.03.jpeg') }}'); background-size: cover; background-position: center;"></div>
            <div style="background-image: url('{{ asset('images/Foto Tas/Tas totebag/WhatsApp Image 2026-06-15 at 21.36.59 (2).jpeg') }}'); background-size: cover; background-position: center;"></div>
            <div style="background-image: url('{{ asset('images/Foto Tas/Tas totebag/WhatsApp Image 2026-06-15 at 21.37.00 (1).jpeg') }}'); background-size: cover; background-position: center;"></div>
            <div style="background-image: url('{{ asset('images/Foto Tas/Tas totebag/WhatsApp Image 2026-06-15 at 21.37.00 (2).jpeg') }}'); background-size: cover; background-position: center;"></div>
            <div style="background-image: url('{{ asset('images/Foto Tas/Tas totebag/WhatsApp Image 2026-06-15 at 21.35.02 (2).jpeg') }}'); background-size: cover; background-position: center;"></div>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="right">

        <span class="badge">Custom Available</span>

        <h1>Tote Bag Terra</h1>

        <h2 class="price">Rp 125.000</h2>

        <div class="rating">
            ⭐⭐⭐⭐⭐ <span>4.9 / 5.0</span>
        </div>

        <p class="desc">
            Tas handmade berbahan kain pilihan dengan desain simple dan elegan.
            Cocok untuk daily use, hadiah, atau request custom.
        </p>

        <div class="info">
            <div><b>Bahan</b><span>Kanvas premium + label kulit</span></div>
            <div><b>Ukuran</b><span>30 cm x 35 cm</span></div>
            <div><b>Warna</b><span>Cocoa, Cream, Sage, Pink</span></div>
            <div><b>Stok</b><span>Ready 8 pcs</span></div>
            <div><b>Estimasi</b><span>Ready 1 hari / Custom 5-7 hari</span></div>
        </div>

        <h3>Catatan Handmade</h3>
        <p class="note">
            Setiap produk dapat memiliki sedikit perbedaan detail karena dibuat secara manual.
        </p>

        <div class="btn-group">
            <button class="btn-primary">Pesan Sekarang</button>
            <button class="btn-outline">Ajukan Custom</button>
        </div>

    </div>

</section>

<!-- <script src="{{ asset('js/detail.js') }}"></script> -->

</body>
</html>