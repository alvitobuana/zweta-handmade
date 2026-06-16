<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Profil - Zweta Handmade</title>

<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>

<!-- NAV -->
<header class="navbar">
    <div class="logo">Zweta Handmade</div>

    <nav>
        <a href="/home">Home</a>
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
<div class="header">
    <h1>Edit Profil</h1>
    <p>Perbarui data diri dan alamat pengiriman pelanggan.</p>
</div>

<!-- FORM CARD -->
<div class="card">

    <label>Nama Lengkap</label>
    <input type="text" value="Zweta Lathifah">

    <label>Email</label>
    <input type="email" value="zweta@email.com">

    <label>Nomor WhatsApp</label>
    <input type="text" value="0812-xxxx-xxxx">

    <label>Alamat / Catatan</label>
    <textarea placeholder="Masukkan alamat lengkap untuk pengiriman pesanan..."></textarea>

    <div class="buttons">
        <button class="btn btn-cancel" onclick="window.location.href='/profile'">Batal</button>
        <button class="btn btn-save">Simpan Perubahan</button>
    </div>

</div>

</body>
</html>