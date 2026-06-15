# Zweta Handmade - Complete Laravel E-Commerce Application

A full-featured handmade bag e-commerce platform built with Laravel 11, featuring customer frontend and complete admin panel.

## 🎯 Features

### Frontend (Customer)
- **Product Catalog** - Browse handmade bags with filter and search
- **Product Details** - View product information with timeline
- **Custom Orders** - Submit custom order requests with specifications
- **Order Tracking** - Track orders by order code in real-time
- **User Authentication** - Secure login/register system

### Admin Panel
- **Dashboard** - Analytics with order stats, revenue, and recent activity
- **Product Management** - Full CRUD operations for products
- **Order Management** - View orders and manage status (Pending → Produksi → Finishing → Selesai)
- **Custom Requests** - Manage custom order requests with status tracking
- **Stock Management** - Inventory tracking for materials (Kain, Tali, Resleting, Benang, Label, Aksesori)
- **Customer Database** - View all customers with purchase history
- **Production Queue** - Kanban-style board for production workflow management

## 🚀 Cara Menjalankan Project (Local Setup)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer/laptop Anda:

### Prasyarat (Prerequisites)
Sebelum memulai, pastikan Anda sudah menginstal:
- **PHP >= 8.2**
- **Composer** (untuk PHP dependency manager)
- **Node.js & NPM** (untuk frontend assets compilation)
- **SQLite** (biasanya sudah include dengan PHP)

---

### Langkah-Langkah Instalasi

1. **Clone Repository ini:**
   ```bash
   git clone https://github.com/alvitobuana/zweta-handmade.git
   cd zweta-handmade
   ```

2. **Instal Dependensi PHP (Composer):**
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend (NPM):**
   ```bash
   npm install
   ```

4. **Salin File Konfigurasi Environment:**
   Buat file `.env` dengan menduplikat `.env.example`:
   - **Windows (PowerShell):**
     ```powershell
     copy .env.example .env
     ```
   - **Mac/Linux atau Git Bash:**
     ```bash
     cp .env.example .env
     ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Siapkan Database SQLite:**
   Secara default, project ini menggunakan SQLite. 
   - Di Windows, Anda bisa membuat file kosong bernama `database.sqlite` di folder `database/`:
     - **Windows (PowerShell):**
       ```powershell
       New-Item -Path database -Name database.sqlite -ItemType File
       ```
     - **Mac/Linux/Git Bash:**
       ```bash
       touch database/database.sqlite
       ```
   - Atau, saat Anda menjalankan perintah migrasi di bawah, Laravel akan secara otomatis mendeteksi jika file `database.sqlite` belum ada dan akan menanyakan apakah Anda ingin membuatnya. Ketik **`yes`** jika ditanya.

7. **Jalankan Migrasi & Seeder Database:**
   Perintah ini akan membuat tabel-tabel database dan mengisi data awal (seperti produk demo, data admin, material, dll):
   ```bash
   php artisan migrate:fresh --seed
   ```

8. **Jalankan Project:**
   Untuk menjalankan aplikasi secara lokal, Anda perlu menyalakan **dua server** berikut secara bersamaan:

   * **Server Backend (Laravel):**
     ```bash
     php artisan serve
     ```
     Aplikasi backend akan berjalan di: **`http://127.0.0.1:8000`**

   * **Server Frontend (Vite):**
     ```bash
     npm run dev
     ```
     Server Vite ini bertugas untuk menyusun (compile) CSS Tailwind dan aset frontend lainnya secara real-time.

---

### 🔑 Demo Akun Admin

Untuk masuk ke halaman Admin Dashboard (`http://127.0.0.1:8000/login`), gunakan kredensial berikut:
- **Email:** `test@example.com`
- **Password:** `password`

## 📋 Database Models

### Products
- name, slug, price, stock, status (ready/pre-order/custom), description

### Orders  
- code, customer_name, product, qty, price, status, notes, created_at

### Custom Requests
- customer_name, email, phone, model, color, notes, deadline, status, created_at

### Customers
- name, email, phone, total_orders, total_spent

### Materials
- name, type, quantity, min_stock, status (aman/habis)

## 🎨 Technology Stack

- **Framework**: Laravel 11
- **Frontend**: Blade templating + Tailwind CSS v4
- **Database**: SQLite
- **Build Tool**: Vite
- **Authentication**: Custom session-based auth
- **Styling**: Custom Tailwind configuration with brand colors

## 🎨 Design System

**Brand Colors:**
- Dark Brown: `#3D2817` (primary)
- Caramel: `#C69C6D` (accent)
- Cream: `#F5F1E8` (background)
- Soft Beige: `#E8DCC8`
- Dusty Pink: `#D4A5A5`
- Sage: `#8B9E7F`

**Typography:**
- Serif: Playfair Display (headings)
- Sans: Poppins (body text)

## 📁 Project Structure

```
├── app/
│   ├── Models/
│   │   ├── Product.php
│   │   ├── Order.php
│   │   ├── CustomRequest.php
│   │   ├── Customer.php
│   │   └── Material.php
│   └── Http/Controllers/
│       ├── AuthController.php
│       ├── ProductController.php
│       ├── CustomRequestController.php
│       ├── OrderTrackingController.php
│       └── Admin/
│           ├── DashboardController.php
│           ├── ProductController.php
│           ├── OrderController.php
│           ├── CustomRequestController.php
│           ├── CustomerController.php
│           ├── MaterialController.php
│           └── ProductionController.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── admin.blade.php
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── orders.blade.php
│   │   │   ├── custom_requests.blade.php
│   │   │   ├── customers.blade.php
│   │   │   ├── materials.blade.php
│   │   │   ├── products/
│   │   │   └── production_queue.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── components/
│   │   │   ├── card.blade.php
│   │   │   ├── badge.blade.php
│   │   │   └── timeline.blade.php
│   │   ├── home.blade.php
│   │   ├── katalog.blade.php
│   │   ├── product.blade.php
│   │   ├── custom.blade.php
│   │   └── tracking.blade.php
│   └── css/
│       └── app.css
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── ProductSeeder.php
│   │   ├── OrderSeeder.php
│   │   ├── CustomRequestSeeder.php
│   │   ├── CustomerSeeder.php
│   │   └── MaterialSeeder.php
│   └── factories/
└── routes/
    └── web.php
```

## 🔑 Key Routes

### Public Routes
- `/` - Homepage with featured products
- `/katalog` - Full product catalog
- `/produk/{slug}` - Product detail page
- `/custom` - Custom order form
- `/tracking` - Order tracking search
- `/login` - Customer login
- `/register` - Customer registration

### Admin Routes (Protected)
- `/admin` - Dashboard
- `/admin/products` - Product management (CRUD)
- `/admin/orders` - Order management with status updates
- `/admin/custom-requests` - Custom request management
- `/admin/materials` - Stock/material management
- `/admin/customers` - Customer database
- `/admin/production` - Production queue kanban board

## 🔐 Authentication & Authorization

The project uses custom session-based authentication:
- Login/register at `/login` and `/register`
- Admin routes protected with `auth` middleware
- Simple password hashing with bcrypt

## 📊 Sample Data

The database is pre-seeded with:
- **6 Products**: Tote Terra, Sling Latte, Pouch Rose, Mini Sage, Daily Cocoa, Bag Cream
- **2 Orders**: ZW-24001 (Aulia), ZW-24002 (Rani)
- **2 Custom Requests**: Aulia (Tote Bag), Rani (Sling)
- **6 Customers**: With purchase history and spending data
- **7 Materials**: Various fabric and accessory items with stock tracking

## 🛠️ Development

### File Organization
- Database logic in Eloquent Models (`app/Models/`)
- Business logic in Controllers (`app/Http/Controllers/`)
- UI templates in Blade files (`resources/views/`)
- Styling with Tailwind CSS (`resources/css/app.css`)
- Routes defined in `routes/web.php`

### Adding New Features
1. Create migration: `php artisan make:migration create_table_name`
2. Create model: `php artisan make:model ModelName -m`
3. Create controller: `php artisan make:controller ControllerName -r`
4. Add routes in `routes/web.php`
5. Create Blade templates in `resources/views/`

## 📝 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
