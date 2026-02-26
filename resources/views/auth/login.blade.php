<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman Alat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #ffffff;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }
        
        .glass-input {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            color: #ffffff;
        }
        
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }
        
        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .glass-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .glass-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .glass-button:active {
            transform: translateY(0);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            right: 15%;
            animation-delay: 5s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 70%;
            animation-delay: 10s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .demo-accounts {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 16px;
            margin-top: 20px;
        }
        
        .demo-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .demo-item:last-child {
            border-bottom: none;
        }
        
        .demo-role {
            font-weight: 600;
            font-size: 12px;
        }
        
        .demo-credentials {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body class="font-sans antialiased flex items-center justify-center min-h-screen relative">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="w-full max-w-md mx-auto p-6">
        @if(session('status'))
            <div class="glass-card rounded-lg p-4 mb-6 border-green-400 border-opacity-50 fade-in">
                <p class="text-green-300">{{ session('status') }}</p>
            </div>
        @endif
        @if(session('success'))
            <div class="glass-card rounded-lg p-4 mb-6 border-green-400 border-opacity-50 fade-in">
                <p class="text-green-300">{{ session('success') }}</p>
            </div>
        @endif
        @if($errors->any())
            <div class="glass-card rounded-lg p-4 mb-6 border-red-400 border-opacity-50 fade-in">
                <p class="text-red-300">{{ $errors->first() }}</p>
            </div>
        @endif
        
        <div class="glass-card rounded-lg p-8 fade-in">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4 4m-4-4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v10"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang</h1>
                <p class="text-gray-200">Masuk ke sistem peminjaman alat</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            class="glass-input w-full pl-10 pr-4 py-3 rounded-lg text-white placeholder-gray-300" 
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            required 
                            autofocus 
                            autocomplete="username"
                        >
                    </div>
                    @error('email')
                        <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-white text-sm font-medium mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            class="glass-input w-full pl-10 pr-4 py-3 rounded-lg text-white placeholder-gray-300" 
                            placeholder="Masukkan password"
                            required 
                            autocomplete="current-password"
                        >
                    </div>
                    @error('password')
                        <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 bg-transparent">
                        <span class="ml-2 text-sm text-gray-200">Ingat saya</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-300 hover:text-blue-200">
                            Lupa password?
                        </a>
                    @endif
                </div>
                
                <button type="submit" class="glass-button w-full px-4 py-3 rounded-lg text-white font-medium">
                    <span class="relative z-10">Login</span>
                </button>

                <p class="mt-6 text-center text-gray-200 text-sm">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-300 hover:text-blue-200 font-medium">Daftar di sini</a>
                </p>
            </form>
            
            <!-- Demo Accounts -->
            <!-- <div class="demo-accounts">
                <p class="text-center text-gray-300 text-sm mb-3 font-medium">
                    🔑 Akun Demo Tersedia:
                </p>
                <div class="space-y-2">
                    <div class="demo-item">
                        <span class="demo-role text-blue-400">Admin:</span>
                        <span class="demo-credentials">admin@admin.com / password</span>
                    </div>
                    <div class="demo-item">
                        <span class="demo-role text-purple-400">Super Admin:</span>
                        <span class="demo-credentials">super@admin.com / password</span>
                    </div>
                    <div class="demo-item">
                        <span class="demo-role text-green-400">Petugas:</span>
                        <span class="demo-credentials">petugas@example.com / password</span>
                    </div>
                    <div class="demo-item">
                        <span class="demo-role text-yellow-400">User:</span>
                        <span class="demo-credentials">user@user.com / password</span>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</body>
</html>
