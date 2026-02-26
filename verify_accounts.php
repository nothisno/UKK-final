<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🎉 VERIFIKASI SEMUA AKUN DEMO 🎉" . PHP_EOL;
echo "======================================" . PHP_EOL;
echo PHP_EOL;

// Get all users
$users = App\Models\User::orderBy('role', 'desc')->get();

echo "� Total Users: " . $users->count() . PHP_EOL;
echo PHP_EOL;

// Admin Accounts
echo "👑 ADMIN ACCOUNTS:" . PHP_EOL;
$admins = $users->where('role', 'admin');
foreach ($admins as $admin) {
    $status = \Illuminate\Support\Facades\Hash::check('password', $admin->password) ? '✅' : '❌';
    echo "{$status} {$admin->name} - {$admin->email} / password" . PHP_EOL;
}

echo PHP_EOL;

// User Accounts
echo "� USER ACCOUNTS:" . PHP_EOL;
$regularUsers = $users->where('role', 'user');
foreach ($regularUsers as $user) {
    $status = \Illuminate\Support\Facades\Hash::check('password', $user->password) ? '✅' : '❌';
    echo "{$status} {$user->name} - {$user->email} / password" . PHP_EOL;
}

echo PHP_EOL;
echo "======================================" . PHP_EOL;
echo "🚀 Semua akun siap digunakan!" . PHP_EOL;
echo "📱 Login di: http://127.0.0.1:8000/login" . PHP_EOL;
echo "💡 Semua password: 'password'" . PHP_EOL;
