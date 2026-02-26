# 📚 Sistem Peminjaman Alat - Dokumentasi Lengkap

## 🌟 Tentang Aplikasi

Aplikasi web berbasis Laravel untuk mengelola peminjaman alat dengan sistem yang lengkap dan modern. Aplikasi ini dirancang untuk memudahkan pengelolaan inventaris alat yang dipinjamkan oleh user.

## 🏗️ Arsitektur & Teknologi

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates dengan TailwindCSS
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Breeze
- **Design Pattern**: MVC (Model-View-Controller)

## 🎨 Desain & UI/UX

### Tema
- **Warna**: Hitam (#000000), Putih (#FFFFFF), Abu-abu elegan (#1a1a1a, #2c2c2c)
- **Style**: Minimalis, Clean, Modern, Elegant

### Glass Morphism Effect
```css
.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.1);
}
```

### Animasi
- Fade in saat load (0.5s)
- Smooth transition 300ms
- Hover scale 1.02
- Sidebar slide animation

## 👥 Role & Hak Akses

### 🔐 Admin
- **CRUD User**: Kelola data pengguna
- **CRUD Alat**: Kelola data inventaris alat
- **CRUD Kategori**: Kelola kategori alat
- **Persetujuan Peminjaman**: Setujui/tolak pengajuan
- **Monitoring Pengembalian**: Pantau proses pengembalian
- **Input Pengembalian**: Catat pengembalian alat
- **Log Activity**: Lihat semua aktivitas sistem
- **Cetak Laporan**: Generate laporan peminjaman & pengembalian

### 👤 User (Peminjam)
- **Daftar Alat**: Lihat katalog alat tersedia
- **Pengajuan Peminjaman**: Ajukan peminjaman alat
- **Status Peminjaman**: Pantau status pengajuan
- **Pengembalian**: Ajukan pengembalian alat

## 📊 Struktur Database

### Tabel Users
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Tabel Kategori
```sql
CREATE TABLE kategoris (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Tabel Alat
```sql
CREATE TABLE alats (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nama_alat VARCHAR(255) NOT NULL,
    kategori_id BIGINT NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    kondisi ENUM('baik', 'rusak_ringan', 'rusak_berat') DEFAULT 'baik',
    deskripsi TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES kategoris(id) ON DELETE CASCADE
);
```

### Tabel Peminjaman
```sql
CREATE TABLE peminjamen (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    alat_id BIGINT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE NOT NULL,
    status ENUM('pending', 'disetujui', 'ditolak', 'dikembalikan') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (alat_id) REFERENCES alats(id) ON DELETE CASCADE
);
```

### Tabel Pengembalian
```sql
CREATE TABLE pengembalian (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    peminjaman_id BIGINT NOT NULL,
    tanggal_dikembalikan DATE NOT NULL,
    kondisi_setelah ENUM('baik', 'rusak_ringan', 'rusak_berat') NOT NULL,
    denda DECIMAL(10,2) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (peminjaman_id) REFERENCES peminjamen(id) ON DELETE CASCADE
);
```

### Tabel Log Activities
```sql
CREATE TABLE log_activities (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    aktivitas VARCHAR(255) NOT NULL,
    waktu TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## 🔧 Instalasi & Konfigurasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & NPM
- Database (MySQL/SQLite)

### Langkah Instalasi
```bash
# Clone repository
git clone <repository-url>
cd peminjaman_alat

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database migration
php artisan migrate

# Seed data (opsional)
php artisan db:seed

# Start development server
php artisan serve
```

## 🚀 Cara Menjalankan

### Development
```bash
php artisan serve
```
Aplikasi akan berjalan di `http://localhost:8000`

### Production
```bash
npm run build
php artisan optimize
php artisan config:cache
php artisan route:cache
```

## 📱 Fitur-Fitur Utama

### 1. Authentication System
- Login dengan email dan password
- Role-based access control
- Session management
- Password hashing otomatis

### 2. Manajemen User (Admin)
- CRUD lengkap data user
- Validasi input data
- Pagination untuk data besar
- Search dan filter

### 3. Manajemen Inventaris (Admin)
- CRUD kategori alat
- CRUD data alat
- Tracking stok otomatis
- Status kondisi alat

### 4. Sistem Peminjaman
- Pengajuan peminjaman oleh user
- Validasi ketersediaan alat
- Workflow persetujuan admin
- Notifikasi status real-time

### 5. Pengembalian & Monitoring
- Input pengembalian oleh admin
- Update stok otomatis
- Tracking denda dan kerusakan
- History lengkap peminjaman

### 6. Laporan & Analytics
- Laporan peminjaman per periode
- Laporan pengembalian per periode
- Log activity tracking
- Export data (PDF/Excel)

## 🎯 Alur Kerja Sistem

### Alur Peminjaman User
1. **Login** → User login ke sistem
2. **Browse Alat** → Lihat katalog alat tersedia
3. **Ajukan Peminjaman** → Isi form pengajuan
4. **Menunggu Persetujuan** → Admin review pengajuan
5. **Status Update** → User menerima notifikasi (disetujui/ditolak)
6. **Peminjaman Aktif** → User dapat menggunakan alat
7. **Pengembalian** → User mengajukan pengembalian
8. **Selesai** → Admin input pengembalian, stok update

### Alur Admin
1. **Login Admin** → Akses dashboard admin
2. **Monitoring** → Lihat semua peminjaman aktif
3. **Persetujuan** → Review dan approve/reject pengajuan
4. **Pengembalian** → Input data pengembalian
5. **Reporting** → Generate laporan dan analytics
6. **Manajemen Data** → CRUD users, alat, kategori

## 🔐 Keamanan

### Authentication
- Password hashing dengan bcrypt
- CSRF protection pada semua form
- Session security
- Rate limiting untuk login

### Authorization
- Role-based access control
- Middleware protection untuk route admin
- Validasi ownership data

### Data Validation
- Server-side validation untuk semua input
- Sanitasi data user
- Custom error messages

## 🎨 Komponen UI

### Glass Components
- **Glass Card**: Container dengan backdrop blur effect
- **Glass Button**: Button dengan hover animation
- **Glass Input**: Form input dengan focus states
- **Glass Sidebar**: Navigation dengan slide animation

### Status Badge
- **Pending**: Orange/Yellow background
- **Approved**: Green background  
- **Rejected**: Red background
- **Returned**: Blue background

### Responsive Design
- Mobile-first approach
- Breakpoint: sm (640px), md (768px), lg (1024px), xl (1280px)
- Touch-friendly interface

## 📝 Logging & Monitoring

### Activity Log
- Semua aktivitas user tercatat
- Timestamp otomatis
- Searchable history
- Filter berdasarkan user dan tanggal

### Error Handling
- Custom error pages
- Validation error display
- Exception logging
- User-friendly error messages

## 🔄 API Endpoints

### Authentication
- `POST /login` - User authentication
- `POST /logout` - User logout
- `GET /dashboard` - Redirect berdasarkan role

### Admin Routes
- `GET /admin/*` - Admin dashboard dan management
- Protected dengan middleware `admin`

### User Routes  
- `GET /user/*` - User dashboard dan peminjaman
- Protected dengan middleware `auth`

## 🎯 Best Practices

### Code Quality
- PSR-4 autoloading
- MVC pattern yang konsisten
- Dependency injection
- Error handling yang proper

### Performance
- Database query optimization
- Pagination untuk data besar
- Caching untuk static data
- Lazy loading untuk relasi

### Security
- Input validation
- SQL injection prevention
- XSS protection
- CSRF protection

## 🐛 Troubleshooting

### Common Issues
1. **Database Connection**: Check .env configuration
2. **Permission Error**: Run `php artisan storage:link`
3. **Migration Error**: Check database compatibility
4. **Asset Loading**: Run `npm install` dan `npm run dev`

### Debug Mode
```bash
# Enable debug mode
APP_DEBUG=true

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## 📈 Pengembangan Masa Depan

### Planned Features
- [ ] Email notifications
- [ ] SMS notifications
- [ ] Barcode/QR code scanning
- [ ] Mobile app integration
- [ ] Advanced reporting
- [ ] API documentation
- [ ] Multi-language support

### Technical Improvements
- [ ] Queue system untuk background jobs
- [ ] Redis caching
- [ ] Load balancing
- [ ] Database optimization
- [ ] Automated testing

## 👥 Tim Pengembang

### Kontributor
- **Backend Developer**: Laravel & PHP
- **Frontend Developer**: Blade & TailwindCSS
- **UI/UX Designer**: Glass morphism design
- **Database Architect**: Schema design & optimization

## 📞 Support & Kontak

### Documentation
- README ini sebagai panduan utama
- Code comments pada setiap method
- API documentation (jika ada)

### Bantuan
- Error reporting melalui log
- User guide di dalam aplikasi
- Admin contact information

---

## 🔑 Akun Demo

### Admin Access
- **Email**: admin@admin.com
- **Password**: password
- **Role**: Full access admin

### User Access  
- **Email**: user@user.com
- **Password**: password
- **Role**: Peminjam/user access

---

*© 2024 Sistem Peminjaman Alat - All rights reserved*
