# 🚀 Sistem Peminjaman Alat

Aplikasi web berbasis Laravel untuk mengelola peminjaman alat dengan desain modern dan glass morphism effect.

## ✨ Fitur Utama

- 🔐 **Authentication System** - Login dengan role-based access (Admin/User)
- 👥 **CRUD Operations** - Kelola Users, Kategori, Alat
- 📋 **Sistem Peminjaman** - Pengajuan, persetujuan, monitoring
- 🔄 **Pengembalian** - Input pengembalian dengan update stok otomatis
- 📊 **Laporan & Analytics** - Generate laporan dan log activity
- 🎨 **Modern UI/UX** - Glass morphism dengan tema hitam-putih minimalis

## 🛠️ Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Database (MySQL/SQLite)

### Langkah-langkah

1. **Clone/Download project**
   ```bash
   cd peminjaman_alat
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed  # Untuk akun demo
   ```

5. **Start server**
   ```bash
   php artisan serve
   ```

## 🔑 Akun Demo

Setelah menjalankan `php artisan db:seed`, Anda bisa login dengan:

### Admin
- **Email**: admin@admin.com
- **Password**: password
- **Akses**: Semua fitur admin

### User
- **Email**: user@user.com  
- **Password**: password
- **Akses**: Fitur peminjaman user

## 🎯 Cara Menggunakan

### Untuk Admin
1. Login sebagai admin
2. Kelola users, kategori, dan alat
3. Setujui/tolak pengajuan peminjaman
4. Input pengembalian alat
5. Generate laporan

### Untuk User
1. Login sebagai user
2. Lihat katalog alat tersedia
3. Ajukan peminjaman alat
4. Monitor status peminjaman
5. Ajukan pengembalian

## 🎨 Desain & UI

### Glass Morphism Effect
- **Background**: Linear gradient black to gray
- **Cards**: Backdrop blur dengan transparansi
- **Buttons**: Hover effects dengan scale transform
- **Inputs**: Focus states dengan border highlight

### Responsive Design
- Mobile-first approach
- Breakpoints: sm(640px), md(768px), lg(1024px)
- Touch-friendly interface

## 📁 Struktur Proyek

```
peminjaman_alat/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   └── User/           # User controllers
│   ├── Models/              # Eloquent models
│   └── Middleware/           # Custom middleware
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/            # Sample data
├── resources/views/
│   ├── layouts/            # Master layout
│   ├── admin/              # Admin views
│   ├── user/               # User views
│   └── auth/               # Authentication views
└── routes/
    └── web.php             # Application routes
```

## 🔧 Konfigurasi Database

### MySQL
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=peminjaman_alat
DB_USERNAME=root
DB_PASSWORD=
```

### SQLite
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

## 📝 Panduan Pembelajaran

### 1. Laravel MVC Pattern
- **Models**: `app/Models/` - Logic data dan relasi
- **Views**: `resources/views/` - Template HTML
- **Controllers**: `app/Http/Controllers/` - Business logic

### 2. Eloquent Relationships
```php
// User.php
public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}

// Peminjaman.php  
public function user()
{
    return $this->belongsTo(User::class);
}
```

### 3. Validation Rules
```php
$validator = Validator::make($request->all(), [
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed',
]);
```

### 4. Middleware Implementation
```php
// AdminMiddleware.php
if (!auth()->user()->isAdmin()) {
    return redirect('/login');
}
```

## 🐛 Troubleshooting

### Error Umum

1. **"Vite manifest not found"**
   - ✅ **Sudah diperbaiki** - Menggunakan CSS inline
   - Tidak perlu `npm install` atau `npm run build`

2. **Database connection failed**
   - Check file `.env` configuration
   - Pastikan database server running

3. **Permission denied**
   - Run: `php artisan storage:link`
   - Check folder permissions

### Debug Mode
```bash
# Enable debug
APP_DEBUG=true

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## 🚀 Production Deployment

### Optimization
```bash
# Optimize untuk production
php artisan optimize --force
php artisan config:cache
php artisan route:cache
```

### Security
- Set `APP_DEBUG=false` di production
- Gunakan environment variables
- HTTPS configuration
- Database security

## 📞 Support

### Dokumentasi Lengkap
Lihat file `README_DOKUMENTASI.md` untuk dokumentasi teknis lengkap:
- Penjelasan setiap controller method
- Schema database lengkap  
- Alur kerja sistem
- Best practices

### Issues & Help
- Error logs: `storage/logs/laravel.log`
- Debug dengan `php artisan tinker`
- Check dokumentasi Laravel resmi

---

## 🎉 Selamat Menggunakan!

Aplikasi ini dirancang untuk pembelajaran Laravel development dengan best practices yang modern. Semua fitur sudah siap digunakan dan telah dioptimalkan untuk performa dan keamanan.

**Happy Coding!** 🚀

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
