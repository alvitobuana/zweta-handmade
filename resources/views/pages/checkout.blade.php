<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout & Pembayaran</title>

    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
<div class="logo">Zweta Handmade</div> 

    <nav>
        <a href="/home">Home</a>
        <a href="/katalog">Katalog</a>
        <a class="active" href="/custom">Custom</a>
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
</div>

<!-- TITLE -->
<div class="page-title">
    <h1>Checkout & Pembayaran</h1>
</div>

<!-- CONTENT -->
<section class="container">

    <!-- LEFT -->
    <div class="card">

        <h2>Ringkasan Pesanan</h2>

        <div class="row">
            <span>Produk</span>
            <b>Tote Bag Terra</b>
        </div>

        <div class="row">
            <span>Custom</span>
            <b>Warna cocoa + inisial ZK</b>
        </div>

        <div class="row">
            <span>Qty</span>
            <b>1</b>
        </div>

        <div class="row">
            <span>Harga</span>
            <b>Rp 125.000</b>
        </div>

        <div class="row">
            <span>Biaya Custom</span>
            <b>Rp 25.000</b>
        </div>

        <div class="row">
            <span>Ongkir</span>
            <b>Rp 15.000</b>
        </div>

        <div class="row total">
            <span>Total</span>
            <b>Rp 165.000</b>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="card">

        <h2>Metode Pembayaran</h2>

        <label><input type="radio" name="pay" value="qris" checked> QRIS</label>
        <label><input type="radio" name="pay" value="transfer"> Transfer Manual</label>
        <label><input type="radio" name="pay" value="cod"> Bayar Langsung/COD</label>

        <div class="qr-box" id="qrisBox">
            QRIS
        </div>

        <p class="status">Menunggu Pembayaran....</p>

    </div>

</section>

<!-- <script src="{{ asset('js/checkout.js') }}"></script> -->

</body>
</html>