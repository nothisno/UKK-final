<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page Title untuk SEO dan Browser Tab -->
<!-- @yield('title', 'PinjamIn') = Default title "PinjamIn" jika tidak ada title khusus -->
<!-- Fungsi: Menampilkan judul halaman di browser tab dan SEO -->
<title>@yield('title', 'PinjamIn')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Glass Effect Styles */
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
        
        .glass-sidebar {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .glass-button {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .glass-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.02);
        }
        
        .glass-input {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
            outline: none;
        }
        
        body {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #2c2c2c 100%);
            min-height: 100vh;
            color: #ffffff;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .status-pending { background: rgba(251, 191, 36, 0.2); color: #fbbf24; }
        .status-approved { background: rgba(34, 197, 94, 0.2); color: #22c55e; }
        .status-rejected { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
        .status-returned { background: rgba(59, 130, 246, 0.2); color: #3b82f6; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-gray-800 text-white">
    <div id="app" class="min-h-screen flex">
        <!-- Sidebar -->
        @auth
            <aside class="glass-sidebar w-64 min-h-screen p-6 animate-slide-in">
                <!-- Brand Logo/Name -->
                <!-- Fungsi: Menampilkan nama aplikasi di sidebar -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2 animate-fade-in">
                       PinjamIn
                    </h1>
                    <!-- Welcome Message dengan nama user yang sedang login -->
                    <!-- Fungsi: Personalisasi dan menampilkan user yang aktif -->
                    <p class="text-gray-400 text-sm">
                        Selamat datang, {{ auth()->user()->name }}
                    </p>
                </div>

                <nav class="space-y-2">
                    @if(auth()->user()->isAdmin() || auth()->user()->isPetugas() || auth()->user()->isSuperAdmin())
                        <!-- Admin / Petugas / Super Admin Navigation -->
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        
                        @if(auth()->user()->canManageUsers())
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Users
                        </a>
                        @endif
                        
                        @if(auth()->user()->canManageKategori())
                        <a href="{{ route('admin.kategoris.index') }}" class="nav-link {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Kategori
                        </a>
                        @endif
                        
                        @if(auth()->user()->canManageAlat())
                        <a href="{{ route('admin.alats.index') }}" class="nav-link {{ request()->routeIs('admin.alats.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Alat
                        </a>
                        @endif
                        
                        @if(auth()->user()->isAdmin() || auth()->user()->isPetugas() || auth()->user()->isSuperAdmin())
                        <a href="{{ route('admin.peminjaman.index') }}" class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Peminjaman
                        </a>
                        @endif
                        
                        @if(auth()->user()->isAdmin() || auth()->user()->isPetugas() || auth()->user()->isSuperAdmin())
                        <a href="{{ route('admin.pengembalian.index') }}" class="nav-link {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pengembalian
                        </a>
                        @endif
                        
                        @if(auth()->user()->canPrintReports() || auth()->user()->isSuperAdmin() || auth()->user()->isPetugas())
                        <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v7m3-2h6"></path>
                            </svg>
                            Laporan
                        </a>
                        @endif

                        <!-- Log Activity - Only Super Admin and Admin -->
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                        <a href="{{ route('admin.laporan.activity') }}" class="nav-link {{ request()->routeIs('admin.laporan.activity') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M9 7h6M4 11h16M4 15h10M4 19h6"></path>
                            </svg>
                            Log Activity
                        </a>
                        @endif

                        <!-- Menu Data Terhapus (Soft Delete) - Admin & Super Admin -->
                        <!-- <a href="{{ route('admin.trash.index') }}" class="nav-link {{ request()->routeIs('admin.trash.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Data Terhapus -->
                        </a>
                    @else
                        <!-- User Navigation -->
                        <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('user.alats.index') }}" class="nav-link {{ request()->routeIs('user.alats.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Katalog Alat
                        </a>
                        
                        <a href="{{ route('user.peminjaman.index') }}" class="nav-link {{ request()->routeIs('user.peminjaman.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Peminjaman Saya
                        </a>

                        <!-- Activity user (hanya aktivitas dirinya sendiri) -->
                        <a href="{{ route('user.activity.index') }}" class="nav-link {{ request()->routeIs('user.activity.*') ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7M5 7h14"></path>
                            </svg>
                            Activity
                        </a>
                    @endif
                </nav>

                <!-- Logout Button -->
                <div class="absolute bottom-6 left-6 right-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full glass-button text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>
        @endauth

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header Section -->
            <!-- Fungsi: Menampilkan judul halaman dan info user di header -->
            <header class="glass-card border-0 border-b border-glass-border m-6 mb-0 p-6 animate-fade-in">
                <div class="flex justify-between items-center">
                  
                    <!-- Fungsi: Menampilkan judul halaman yang sedang aktif -->
                    <h1 class="text-3xl font-bold text-white">
                        @yield('title', 'Dashboard')
                    </h1>
                    <div class="flex items-center space-x-4">
                        <!-- User Info (Nama dan Avatar) -->
                        <!-- Fungsi: Menampilkan info user yang sedang login -->
                        <span class="text-gray-400">
    {{ auth()->user()->name }}
</span>
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6 animate-fade-in">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-4 right-4 glass-card p-4 border-l-4 border-green-500 animate-fade-in z-50">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-white">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 glass-card p-4 border-l-4 border-red-500 animate-fade-in z-50">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-white">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- JavaScript -->
    <script>
        // Auto-hide flash messages
        setTimeout(() => {
            const messages = document.querySelectorAll('.fixed.top-4.right-4');
            messages.forEach(msg => {
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 300);
            });
        }, 5000);

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
