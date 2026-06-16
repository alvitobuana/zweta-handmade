# 🎀 Zweta Handmade — Platform E-Commerce Tas Handmade

Platform penjualan tas handmade berbasis web yang dibangun dengan **Laravel 11**, lengkap dengan antarmuka pelanggan yang modern dan panel admin yang komprehensif.

---

## ✨ Fitur Utama

### 🛍️ Frontend (Pelanggan)
| Fitur | Keterangan |
|---|---|
| **Halaman Beranda** | Showcase produk unggulan, hero section, dan FAQ |
| **Katalog Produk** | Browse produk dengan filter status & pencarian real-time |
| **Detail Produk** | Info lengkap produk, timeline produksi, wishlist & bagikan |
| **Stok Habis** | Badge "Habis" otomatis & tombol pesan di-disable jika stok = 0 |
| **Custom Order** | Form pengajuan tas custom (model, warna, ukuran, catatan) |
| **Lacak Pesanan** | Tracking otomatis tanpa input kode jika sudah login |
| **Upload Bukti Bayar** | Upload foto transfer & lihat status verifikasi |
| **Profil Saya** | Kelola data akun + pantau status pesanan terbaru |
| **Edit Profil** | Update nama, email, WhatsApp, alamat, dan password |
| **Halaman Kontak** | Info kontak lengkap (WhatsApp, Email, Instagram, Alamat) |
| **Login / Register** | Autentikasi berbasis sesi yang aman |

### ⚙️ Admin Panel (`/admin`)
| Fitur | Keterangan |
|---|---|
| **Dashboard** | Statistik pesanan, revenue, custom order, & produk |
| **Manajemen Produk** | CRUD lengkap termasuk upload foto & pengaturan stok |
| **Manajemen Pesanan** | Lihat, update status, verifikasi/tolak bukti pembayaran |
| **Custom Request** | Kelola permintaan custom order dari pelanggan |
| **Production Queue** | Kanban board alur produksi (Menunggu → Finishing → Selesai) |
| **Stok Bahan** | Tambah, edit, hapus bahan baku + indikator Aman/Menipis/Habis |
| **Laporan Penjualan** | Grafik revenue, tren penjualan, & rincian transaksi |
| **Data Customer** | Tabel pelanggan dengan riwayat pembelian & detail lengkap |

---

## 🚀 Cara Menjalankan (Local Setup)

### Prasyarat
Pastikan sudah terinstal:
- **PHP >= 8.2**
- **Composer**
- **Node.js & NPM**
- **SQLite** (biasanya sudah include dengan PHP)

### Langkah Instalasi

**1. Clone Repository**
```bash
git clone https://github.com/alvitobuana/zweta-handmade.git
cd zweta-handmade
```

**2. Install Dependensi**
```bash
composer install
npm install
```

**3. Buat File Environment**
```powershell
# Windows (PowerShell)
copy .env.example .env

# Mac / Linux
cp .env.example .env
```

**4. Generate App Key**
```bash
php artisan key:generate
```

**5. Buat File Database SQLite**
```powershell
# Windows (PowerShell)
New-Item -Path database -Name database.sqlite -ItemType File

# Mac / Linux
touch database/database.sqlite
```

**6. Jalankan Migrasi & Seeder**
```bash
php artisan migrate:fresh --seed
```

**7. Jalankan Server (buka 2 terminal)**
```bash
# Terminal 1 — Backend Laravel
php artisan serve

# Terminal 2 — Frontend Vite (CSS & JS)
npm run dev
```

Buka di browser: **http://localhost:8000**

---

## 🔑 Akun Demo

| Role | Email | Password |
|---|---|---|
| **Admin** | `zwetaadmin@gmail.com` | `password` |
| **User** | `user@example.com` | `password` |

---

## 🗺️ Daftar Route

### Public
| Route | Keterangan |
|---|---|
| `/` | Beranda |
| `/katalog` | Katalog produk |
| `/produk/{slug}` | Detail produk |
| `/custom` | Form custom order |
| `/tracking` | Lacak pesanan |
| `/kontak` | Halaman kontak |
| `/login` | Login |
| `/register` | Registrasi |

### User (Harus Login)
| Route | Keterangan |
|---|---|
| `/profile` | Profil saya |
| `/profile/edit` | Edit profil |
| `/produk/{slug}/order` | Buat pesanan |
| `/tracking/{code}/receipt` | Upload bukti bayar |

### Admin (Harus Login sebagai Admin)
| Route | Keterangan |
|---|---|
| `/admin` | Dashboard |
| `/admin/products` | Manajemen produk |
| `/admin/orders` | Manajemen pesanan |
| `/admin/custom-requests` | Custom request |
| `/admin/production` | Production queue |
| `/admin/materials` | Stok bahan |
| `/admin/reports` | Laporan penjualan |
| `/admin/customers` | Data customer |

---

## 🗄️ Struktur Database

### `users`
`id` · `name` · `email` · `password` · `whatsapp` · `address` · `is_admin`

### `products`
`id` · `name` · `slug` · `price` · `stock` · `status` (ready/pre-order/custom) · `description` · `image`

### `orders`
`id` · `code` · `customer_name` · `product` · `qty` · `price` · `status` · `notes` · `payment_receipt`

### `custom_requests`
`id` · `customer_name` · `email` · `phone` · `model` · `color` · `notes` · `deadline` · `status`

### `materials`
`id` · `name` · `type` · `quantity` · `min_stock` · `status` (aman/menipis/habis)

### `customers`
`id` · `name` · `email` · `phone` · `total_orders` · `total_spent`

---

## 🎨 Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| **Laravel 11** | Backend framework |
| **Blade** | Template engine |
| **Tailwind CSS v4** | Styling & UI |
| **Vite** | Build tool frontend |
| **SQLite** | Database |
| **Playfair Display + Poppins** | Tipografi |

### Palet Warna Brand
```
Dark Brown  #4B2B20   ← Teks utama & sidebar admin
Caramel     #A56A43   ← Aksen & tombol utama
Cream       #FFF8F2   ← Background utama
Soft Beige  #EAD9CC   ← Border & card
Dusty Pink  #D89CA4   ← Aksen sekunder
```

---

## 📦 Data Awal (Seeder)

Setelah `migrate:fresh --seed`, database terisi dengan:
- **7 Produk**: Tote Terra, Sling Latte, Pouch Rose, Mini Sage, Daily Cocoa, dll.
- **Beberapa Pesanan** dengan berbagai status
- **Custom Request** dari pelanggan contoh
- **7 Bahan**: Kulit, Kain, Resleting, Benang, Label, Aksesori, dll.
- **6 Customer** dengan riwayat transaksi

---

## 📁 Struktur Folder Utama

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          ← Controller admin panel
│   │   ├── AuthController.php
│   │   ├── ProductController.php
│   │   ├── OrderTrackingController.php
│   │   └── UserController.php
│   └── Models/
│       ├── Product.php · Order.php · User.php
│       ├── CustomRequest.php · Customer.php · Material.php
├── resources/views/
│   ├── admin/              ← Semua tampilan admin
│   ├── auth/               ← Login & Register
│   ├── components/         ← Komponen reusable (card, badge, timeline)
│   ├── layouts/            ← Layout utama (app & admin)
│   ├── pages/              ← Halaman user (profile, kontak, dll.)
│   ├── partials/           ← Header & Footer
│   ├── home.blade.php · katalog.blade.php
│   ├── product.blade.php · custom.blade.php · tracking.blade.php
├── database/
│   ├── migrations/
│   └── seeders/
└── routes/web.php
```

---

## 👨‍💻 Dibuat oleh

**Zweta Handmade Team** — Tugas Besar Pemrograman Berbasis Komponen  
Universitas · 2026
