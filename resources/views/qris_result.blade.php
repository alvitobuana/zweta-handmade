<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>{{ $success ? 'Pembayaran Berhasil ✅' : 'Pembayaran Gagal ❌' }} - Zweta Handmade</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --caramel: #A0522D;
            --dark-brown: #3B1F0A;
            --soft-beige: #F5E6D3;
            --cream: #FFF8F0;
            --green: #16a34a;
            --red: #dc2626;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px 20px;
            overflow-x: hidden;
        }

        /* Animated background blob */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 20%, rgba(160,82,45,0.08) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(245,230,211,0.6) 0%, transparent 50%);
            z-index: 0;
            pointer-events: none;
        }

        .card {
            position: relative;
            z-index: 1;
            background: white;
            border-radius: 28px;
            padding: 36px 28px;
            max-width: 380px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(160,82,45,0.12), 0 4px 16px rgba(0,0,0,0.06);
            text-align: center;
            animation: slideUp 0.5s cubic-bezier(0.34,1.56,0.64,1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .icon-wrap {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            position: relative;
        }

        .icon-wrap.success {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            animation: popIn 0.6s 0.3s cubic-bezier(0.34,1.56,0.64,1) both;
        }

        .icon-wrap.error {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            animation: popIn 0.6s 0.3s cubic-bezier(0.34,1.56,0.64,1) both;
        }

        .icon-wrap.already {
            background: linear-gradient(135deg, #fef9c3, #fde68a);
        }

        @keyframes popIn {
            from { opacity: 0; transform: scale(0); }
            to   { opacity: 1; transform: scale(1); }
        }

        /* Ripple effect for success */
        .icon-wrap.success::after {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 2px solid #16a34a;
            opacity: 0;
            animation: ripple 1.5s 0.8s ease-out infinite;
        }
        @keyframes ripple {
            0%   { inset: -4px; opacity: 0.6; }
            100% { inset: -20px; opacity: 0; }
        }

        h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark-brown);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .subtitle {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .order-box {
            background: var(--soft-beige);
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 20px;
            text-align: left;
        }

        .order-box .label {
            font-size: 10px;
            font-weight: 700;
            color: var(--caramel);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }

        .order-box .value {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark-brown);
        }

        .order-box .meta {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }

        .amount {
            font-size: 26px;
            font-weight: 700;
            color: var(--caramel);
            margin: 4px 0 8px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.success { background: #dcfce7; color: #15803d; }
        .badge.pending { background: #fef9c3; color: #a16207; }

        .divider {
            border: none;
            border-top: 1px solid var(--soft-beige);
            margin: 20px 0;
        }

        .back-btn {
            display: block;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--caramel), #c2703a);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            margin-top: 8px;
            box-shadow: 0 4px 16px rgba(160,82,45,0.3);
            transition: opacity 0.2s;
        }

        .back-btn:active { opacity: 0.85; }

        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 28px;
            position: relative;
            z-index: 1;
        }

        .brand-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--caramel);
        }

        .brand-sub {
            font-size: 11px;
            color: #9ca3af;
            text-align: center;
            margin-top: 4px;
        }

        /* Confetti particles for success */
        .confetti-wrap {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 10;
            overflow: hidden;
        }

        .confetti-piece {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 2px;
            animation: confettiFall linear both;
        }

        @keyframes confettiFall {
            0%   { transform: translateY(-20px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }

        .error-title { color: var(--red); }
    </style>
</head>
<body>

@if($success && !($alreadyPaid ?? false))
{{-- Confetti particles --}}
<div class="confetti-wrap" id="confettiWrap"></div>
@endif

<div class="card">
    @if($success)
        <div class="icon-wrap {{ ($alreadyPaid ?? false) ? 'already' : 'success' }}">
            {{ ($alreadyPaid ?? false) ? '⚠️' : '✅' }}
        </div>
        <h1>{{ ($alreadyPaid ?? false) ? 'Sudah Dibayar' : 'Pembayaran Berhasil!' }}</h1>
        <p class="subtitle">
            @if($alreadyPaid ?? false)
                Pesanan ini sudah terverifikasi sebelumnya. Tidak ada tindakan yang perlu dilakukan.
            @else
                QRIS berhasil dideteksi. Pesanan Anda kini <strong>sedang diproses</strong> oleh tim Zweta Handmade. 🎉
            @endif
        </p>

        @if(isset($order))
        <div class="order-box">
            <div class="label">Detail Pesanan</div>
            <div class="value">{{ $order->product }}</div>
            <div class="meta">Kode: {{ $order->code }}</div>
            <div class="amount">Rp {{ number_format($order->price, 0, ',', '.') }}</div>
            <span class="badge {{ $order->status === 'produksi' ? 'success' : 'pending' }}">
                @if($order->status === 'produksi') ✓ Terverifikasi & Produksi
                @else ⏳ {{ ucfirst($order->status) }}
                @endif
            </span>
        </div>
        @endif

        <hr class="divider">

        <p style="font-size:12px; color:#6b7280; margin-bottom:14px;">
            Halaman ini dapat ditutup. Terima kasih telah berbelanja di Zweta Handmade!
        </p>

        <a href="https://zweta-handmade.fly.dev/tracking?code={{ $order->code ?? '' }}" class="back-btn">
            🔍 Lihat Status Pesanan
        </a>

    @else
        <div class="icon-wrap error">❌</div>
        <h1 class="error-title">Pesanan Tidak Ditemukan</h1>
        <p class="subtitle">{{ $message ?? 'Kode pesanan tidak valid atau sudah tidak ada.' }}</p>

        <a href="https://zweta-handmade.fly.dev/tracking" class="back-btn" style="background: linear-gradient(135deg,#dc2626,#ef4444);">
            ↩ Kembali ke Halaman Tracking
        </a>
    @endif
</div>

<div class="brand">
    <div>
        <div class="brand-text">🎒 Zweta Handmade</div>
        <div class="brand-sub">Tas Handmade Premium Indonesia</div>
    </div>
</div>

@if($success && !($alreadyPaid ?? false))
<script>
    // Generate confetti
    const colors = ['#A0522D','#F5E6D3','#c2703a','#fde68a','#bbf7d0','#bfdbfe'];
    const wrap = document.getElementById('confettiWrap');
    for (let i = 0; i < 60; i++) {
        const el = document.createElement('div');
        el.className = 'confetti-piece';
        el.style.cssText = `
            left: ${Math.random() * 100}%;
            top: ${-10 - Math.random() * 20}px;
            background: ${colors[Math.floor(Math.random() * colors.length)]};
            width: ${6 + Math.random() * 8}px;
            height: ${6 + Math.random() * 8}px;
            border-radius: ${Math.random() > 0.5 ? '50%' : '2px'};
            animation-duration: ${1.5 + Math.random() * 2}s;
            animation-delay: ${Math.random() * 0.8}s;
        `;
        wrap.appendChild(el);
    }
    // Auto-remove confetti after 4s
    setTimeout(() => { if(wrap) wrap.remove(); }, 4000);
</script>
@endif

</body>
</html>
