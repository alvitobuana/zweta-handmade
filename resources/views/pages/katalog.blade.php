<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Katalog - Zweta Handmade</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">Zweta Handmade</div>

    <nav>
        <a href="/home">Home</a>
        <a class="active" href="/Katalog">Katalog</a>
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
<section class="page-title">
    <h1>Katalog Produk</h1>
    <p>Temukan produk ready stock, pre-order, atau custom.</p>
</section>

<!-- MAIN -->
<div class="container">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="box">
            <h3>Search</h3>
            <input placeholder="Cari produk...">
        </div>

        <div class="box">
            <h3>Kategori</h3>
            <label><input type="checkbox"> Tote Bag</label>
            <label><input type="checkbox"> Sling Bag</label>
            <label><input type="checkbox"> Pouch</label>
            <label><input type="checkbox"> Hampers</label>
            <label><input type="checkbox"> Custom Gift</label>
        </div>

        <div class="box">
            <h3>Status</h3>
            <label><input type="checkbox"> Ready Stock</label>
            <label><input type="checkbox"> Pre-Order</label>
            <label><input type="checkbox"> Custom Available</label>
        </div>

        <div class="range-wrapper">

        <div class="slider-track"></div>

            <input type="range" min="50000" max="250000" value="50000" class="range-min">
            <input type="range" min="50000" max="250000" value="250000" class="range-max">

        </div>

<div class="price">
    <span>Rp 50.000</span>
    <span>Rp 250.000</span>
</div>

        <button class="apply">Apply Filter</button>

    </aside>

    <!-- CONTENT -->
    <main class="content">

    <div class="topbar">
        <span class="product-count">28 produk ditemukan</span>
        <button class="sort">Sort: Terbaru</button>
    </div>

        <div class="grid">

            <!-- CARD -->
            <div class="card">
                <div class="img"></div>
                <h4>Tote Terra</h4>
                <p>Rp 85.000</p>
                <div class="card-bottom">
                    <span class="tag custom-tag">Custom</span>
                    <a href="{{ url('/detail') }}" class="btn-detail">Detail</a>
                </div>
            </div>

            <div class="card">
                <div class="img"></div>
                <h4>Sling Latte</h4>
                <p>Rp 85.000</p>
                <div class="card-bottom">
                    <span class="tag custom-tag">Custom</span>
                    <a href="{{ url('/detail') }}" class="btn-detail">Detail</a>
                </div>
            </div>

            <div class="card">
                <div class="img"></div>
                <h4>Pouch Rose</h4>
                <p>Rp 85.000</p>
                <div class="card-bottom">
                    <span class="tag custom-tag">Custom</span>
                    <a href="{{ url('/detail') }}" class="btn-detail">Detail</a>
                </div>
            </div>

            <div class="card">
                <div class="img"></div>
                <h4>Mini Sage</h4>
                <p>Rp 85.000</p>
                <div class="card-bottom">
                    <span class="tag custom-tag">Custom</span>
                    <a href="{{ url('/detail') }}" class="btn-detail">Detail</a>
                </div>
            </div>

            <div class="card">
                <div class="img"></div>
                <h4>Daily Cocoa</h4>
                <p>Rp 85.000</p>
                <div class="card-bottom">
                    <span class="tag custom-tag">Custom</span>
                    <a href="{{ url('/detail') }}" class="btn-detail">Detail</a>
                </div>
            </div>

            <div class="card">
                <div class="img"></div>
                <h4>Bag Cream</h4>
                <p>Rp 85.000</p>
                <div class="card-bottom">
                    <span class="tag custom-tag">Custom</span>
                    <a href="{{ url('/detail') }}" class="btn-detail">Detail</a>
                </div>
            </div>

        </div>

    </main>

</div>

<!-- <script src="script.js"></script> -->
</body>
</html>