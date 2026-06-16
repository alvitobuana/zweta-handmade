<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Custom Order - Zweta Handmade</title>

<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>

<!-- NAV -->
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
<div class="header">
    <h1>Custom Order</h1>
    <p>Isi detail pesanan custom. Admin akan menentukan harga dan estimasi</p>
    <p>pengerjaan berdasarkan request.</p>
</div>

<!-- CONTENT -->
<div class="container">

    <!-- LEFT -->
    <div class="preview-card">

    <div class="preview-box">
        <div class="preview-label">Preview Produk</div>
    </div>

    <div class="preview-info">

            <h3>Preview Custom</h3>

            <p>Harga dasar: <b>Rp 125.000</b></p>
            <p>Estimasi dasar: <b>5 hari</b></p>

            <div class="badge status">Menunggu Konfirmasi Admin</div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="form-card">

    <div class="section-title">1. Informasi Customer</div>

    <div class="grid-2">
        <div class="field">
            <label>Nama Customer</label>
            <input placeholder="Zweta">
        </div>

        <div class="field">
            <label>Nomor WhatsApp</label>
            <input placeholder="08xxxxxxxxxx">
        </div>

        <div class="field full">
            <label>Email</label>
            <input placeholder="email@email.com">
        </div>
    </div>

    <div class="section-title">2. Detail Custom</div>

    <div class="grid-2">
        <div class="field">
            <label>Model Tas</label>
            <input placeholder="Tote Bag">
        </div>

        <div class="field">
            <label>Warna Utama</label>
            <input placeholder="Cocoa Brown">
        </div>

        <div class="field">
            <label>Warna Tambahan</label>
            <input placeholder="Cream">
        </div>

        <div class="field">
            <label>Ukuran</label>
            <input placeholder="Medium">
        </div>

        <div class="field">
            <label>Upload Referensi</label>
            <input placeholder="Upload image">
        </div>

        <div class="field">
            <label>Nama/Inisial</label>
            <input placeholder="ZK">
        </div>

        <div class="field full">
            <label>Deadline</label>
            <input placeholder="DD/MM/YYYY">
        </div>

        <div class="field full">
            <label>Catatan Request</label>
            <textarea placeholder="Contoh: warna lebih soft, tambah label kecil."></textarea>
        </div>
    </div>

    <div class="section-title">Ringkasan Estimasi</div>

    <div class="summary">
        Harga final dan estimasi akan dikonfirmasi admin setelah request dikirim.
    </div>

    <a href="{{ url('/checkout') }}" class="btn">Kirim Request</a>

</div>

</body>
</html>