<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tracking Pesanan</title>

    <link rel="stylesheet" href="{{ asset('css/tracking.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">Zweta Handmade</div> 

    <nav>
        <a href="/home">Home</a>
        <a href="/katalog">Katalog</a>
        <a href="/custom">Custom</a>
        <a class="active" href="Tracking">Tracking</a>
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
</div>

<!-- TITLE -->
<div class="page-title">
    <h1>Tracking Pesanan</h1>
</div>

<!-- SEARCH -->
<div class="search-box">
    <input type="text" placeholder="Contoh: ZW-24001">
    <button>Cari</button>
</div>

<!-- TIMELINE CARD -->
<div class="timeline-card">

    <h2>Timeline Pesanan ZW-24001</h2>

    <div class="timeline">

        <div class="step done">
            <div class="dot"></div>
            <div class="line"></div>
            <div class="content">
                <h4>Pesanan Dibuat</h4>
                <span>12 Juni 2026</span>
            </div>
        </div>

        <div class="step done">
            <div class="dot"></div>
            <div class="line"></div>
            <div class="content">
                <h4>Pembayaran Diverifikasi</h4>
                <span>12 Juni 2026</span>
            </div>
        </div>

        <div class="step done">
            <div class="dot"></div>
            <div class="line"></div>
            <div class="content">
                <h4>Masuk Antrian Produksi</h4>
                <span>12 Juni 2026</span>
            </div>
        </div>

        <div class="step done">
            <div class="dot"></div>
            <div class="line"></div>
            <div class="content">
                <h4>Sedang Dibuat</h4>
                <span>12 Juni 2026</span>
            </div>
        </div>

        <div class="step">
            <div class="dot"></div>
            <div class="line"></div>
            <div class="content">
                <h4>Finishing</h4>
                <span>Menunggu update</span>
            </div>
        </div>

        <div class="step">
            <div class="dot"></div>
            <div class="line"></div>
            <div class="content">
                <h4>Siap Dikirim</h4>
                <span>Menunggu update</span>
            </div>
        </div>

        <div class="step">
            <div class="dot"></div>
            <div class="line"></div>
            <div class="content">
                <h4>Selesai</h4>
                <span>Menunggu update</span>
            </div>
        </div>

    </div>

</div>

<!-- <script src="{{ asset('js/tracking.js') }}"></script> -->

</body>
</html>