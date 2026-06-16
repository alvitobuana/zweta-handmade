<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya - Zweta Handmade</title>

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

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
    <h1>Profil Saya</h1>
    <p>Kelola data akun dan pantau riwayat pesanan Zweta Handmade.</p>
</div>

<!-- CONTENT -->
<div class="container">

    <!-- LEFT -->
    <div class="card">

        <div class="profile-header">
            <div class="avatar">👤</div>
            <div>
                <div class="profile-name">Zweta Lathifah</div>
                <small>Customer</small>
            </div>
        </div>

        <label>Email</label>
        <input class="input" placeholder="zweta@email.com">

        <label>Nomor WhatsApp</label>
        <input class="input" placeholder="0812-xxxx-xxxx">

        <label>Alamat</label>
        <input class="input" placeholder="Bekasi, Jawa Barat">

    </div>

    <!-- RIGHT -->
    <div class="card">

        <div class="status-title">Status Pesanan Terbaru</div>
        <div class="order-code">ZW240015</div>
        <div><b>Tote Bag Canvas Custom</b></div>
        <small>Estimasi selesai: 15 Juni 2026</small>

        <div class="badge">Produksi</div>

        <div class="timeline">

            <div class="step active">
                <div class="dot"></div>
                <span>Diterima</span>
            </div>

            <div class="step active">
                <div class="dot"></div>
                <span>Bayar</span>
            </div>

            <div class="step active">
                <div class="dot"></div>
                <span>Produksi</span>
            </div>

            <div class="step">
                <div class="dot"></div>
                <span>Finishing</span>
            </div>

            <div class="step">
                <div class="dot"></div>
                <span>Selesai</span>
            </div>

        </div>

    </div>

</div>

<!-- BUTTON -->
<div class="actions left">
    <button class="btn btn-primary" onclick="window.location.href='/edit'">
        Edit Profil
    </button>

    <button class="btn btn-outline" onclick="openLogout()">
        Logout
    </button>
</div>

<script>
console.log("Profil page ready");
</script>

<!-- LOGOUT MODAL -->
<div class="logout-overlay" id="logoutModal">

    <div class="logout-box">

        <h2>Konfirmasi Logout</h2>

        <p>Apakah kamu yakin ingin keluar dari akun Zweta Handmade?</p>

        <div class="logout-icon">⤴</div>

        <div class="logout-action">
            <button class="btn-cancel" onclick="closeLogout()">Batal</button>

            <a href="/login" class="btn-logout">Logout</a>
        </div>

    </div>

</div>

</body>

<script>
function openLogout(){
    document.getElementById("logoutModal").style.display = "flex";
}

function closeLogout(){
    document.getElementById("logoutModal").style.display = "none";
}
</script>

</html>