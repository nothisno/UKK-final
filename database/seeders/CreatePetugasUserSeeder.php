<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreatePetugasUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user petugas sudah ada
        $existingPetugas = User::where('email', 'petugas@example.com')->first();
        
        if (!$existingPetugas) {
            // Buat user dengan role petugas
            User::create([
                'name' => 'Petugas',
                'email' => 'petugas@example.com',
                'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
                'role' => 'petugas',
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('User Petugas berhasil dibuat!');
            $this->command->info('Email: petugas@example.com');
            $this->command->info('Password: password');
        } else {
            $this->command->info('User Petugas sudah ada di database.');
        }
    }
}
