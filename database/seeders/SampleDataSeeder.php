<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['nama_kategori' => 'Elektronik', 'deskripsi' => 'Peralatan elektronik dan gadget'],
            ['nama_kategori' => 'Peralatan Kantor', 'deskripsi' => 'Peralatan untuk kebutuhan kantor'],
            ['nama_kategori' => 'Alat Berat', 'deskripsi' => 'Peralatan konstruksi dan alat berat'],
            ['nama_kategori' => 'Komputer & IT', 'deskripsi' => 'Peralatan komputer dan teknologi informasi'],
            ['nama_kategori' => 'Audio Visual', 'deskripsi' => 'Peralatan audio dan visual'],
            ['nama_kategori' => 'Olahraga', 'deskripsi' => 'Peralatan olahraga dan fitness'],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }

        // Create Tools/Alat
        $elektronik = Kategori::where('nama_kategori', 'Elektronik')->first();
        $kantor = Kategori::where('nama_kategori', 'Peralatan Kantor')->first();
        $berat = Kategori::where('nama_kategori', 'Alat Berat')->first();
        $komputer = Kategori::where('nama_kategori', 'Komputer & IT')->first();
        $av = Kategori::where('nama_kategori', 'Audio Visual')->first();
        $olahraga = Kategori::where('nama_kategori', 'Olahraga')->first();

        $alats = [
            // Elektronik
            ['nama_alat' => 'Laptop ASUS ROG', 'kategori_id' => $elektronik->id, 'stok' => 5, 'kondisi' => 'baik', 'deskripsi' => 'Laptop gaming high performance'],
            ['nama_alat' => 'Printer Epson L3210', 'kategori_id' => $elektronik->id, 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Printer multifungsi'],
            ['nama_alat' => 'Proyektor BenQ', 'kategori_id' => $elektronik->id, 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Proyektor presentasi'],
            
            // Peralatan Kantor
            ['nama_alat' => 'Meja Kerja', 'kategori_id' => $kantor->id, 'stok' => 10, 'kondisi' => 'baik', 'deskripsi' => 'Meja kerja ergonomis'],
            ['nama_alat' => 'Kursi Kantor', 'kategori_id' => $kantor->id, 'stok' => 15, 'kondisi' => 'baik', 'deskripsi' => 'Kursi kantor dengan sandaran'],
            ['nama_alat' => 'Filing Cabinet', 'kategori_id' => $kantor->id, 'stok' => 4, 'kondisi' => 'rusak_ringan', 'deskripsi' => 'Lemari arsip kantor'],
            
            // Alat Berat
            ['nama_alat' => 'Bor Listrik', 'kategori_id' => $berat->id, 'stok' => 3, 'kondisi' => 'baik', 'deskripsi' => 'Bor listrik dengan berbagai mata bor'],
            ['nama_alat' => 'Gerinda Tangan', 'kategori_id' => $berat->id, 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Gerinda tangan untuk cutting'],
            ['nama_alat' => 'Palu Godam', 'kategori_id' => $berat->id, 'stok' => 5, 'kondisi' => 'baik', 'deskripsi' => 'Palu godam untuk konstruksi'],
            
            // Komputer & IT
            ['nama_alat' => 'PC Desktop Core i7', 'kategori_id' => $komputer->id, 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'PC desktop untuk programming'],
            ['nama_alat' => 'Monitor LG 24"', 'kategori_id' => $komputer->id, 'stok' => 6, 'kondisi' => 'baik', 'deskripsi' => 'Monitor LED 24 inch'],
            ['nama_alat' => 'Keyboard Mechanical', 'kategori_id' => $komputer->id, 'stok' => 8, 'kondisi' => 'baik', 'deskripsi' => 'Keyboard mechanical RGB'],
            
            // Audio Visual
            ['nama_alat' => 'Speaker Bluetooth', 'kategori_id' => $av->id, 'stok' => 4, 'kondisi' => 'baik', 'deskripsi' => 'Speaker bluetooth portable'],
            ['nama_alat' => 'Microphone Wireless', 'kategori_id' => $av->id, 'stok' => 2, 'kondisi' => 'baik', 'deskripsi' => 'Microphone wireless untuk presentasi'],
            ['nama_alat' => 'Camera DSLR', 'kategori_id' => $av->id, 'stok' => 1, 'kondisi' => 'rusak_ringan', 'deskripsi' => 'Kamera DSLR untuk dokumentasi'],
            
            // Olahraga
            ['nama_alat' => 'Basket Ball', 'kategori_id' => $olahraga->id, 'stok' => 10, 'kondisi' => 'baik', 'deskripsi' => 'Bola basket standar'],
            ['nama_alat' => 'Sepak Bola', 'kategori_id' => $olahraga->id, 'stok' => 8, 'kondisi' => 'baik', 'deskripsi' => 'Bola sepak bola'],
            ['nama_alat' => 'Raket Badminton', 'kategori_id' => $olahraga->id, 'stok' => 6, 'kondisi' => 'baik', 'deskripsi' => 'Raket badminton professional'],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }

        // Create Sample Peminjaman
        $users = User::where('role', 'user')->get();
        $alatList = Alat::all();
        
        $peminjamanData = [
            [
                'user_id' => $users->first()->id,
                'alat_id' => $alatList->where('nama_alat', 'Laptop ASUS ROG')->first()->id,
                'tanggal_pinjam' => now()->subDays(5),
                'tanggal_kembali' => now()->addDays(2),
                'status' => 'disetujui',
            ],
            [
                'user_id' => $users->skip(1)->first()->id,
                'alat_id' => $alatList->where('nama_alat', 'Printer Epson L3210')->first()->id,
                'tanggal_pinjam' => now()->subDays(3),
                'tanggal_kembali' => now()->addDays(4),
                'status' => 'pending',
            ],
            [
                'user_id' => $users->skip(2)->first()->id,
                'alat_id' => $alatList->where('nama_alat', 'Proyektor BenQ')->first()->id,
                'tanggal_pinjam' => now()->subDays(7),
                'tanggal_kembali' => now()->subDays(1),
                'status' => 'dikembalikan',
            ],
            [
                'user_id' => $users->skip(3)->first()->id,
                'alat_id' => $alatList->where('nama_alat', 'PC Desktop Core i7')->first()->id,
                'tanggal_pinjam' => now()->subDays(2),
                'tanggal_kembali' => now()->addDays(5),
                'status' => 'disetujui',
            ],
            [
                'user_id' => $users->skip(4)->first()->id,
                'alat_id' => $alatList->where('nama_alat', 'Speaker Bluetooth')->first()->id,
                'tanggal_pinjam' => now()->subDays(1),
                'tanggal_kembali' => now()->addDays(3),
                'status' => 'ditolak',
            ],
        ];

        foreach ($peminjamanData as $data) {
            Peminjaman::create($data);
        }

        // Create Sample Pengembalian for returned items
        $returnedPeminjaman = Peminjaman::where('status', 'dikembalikan')->get();
        
        foreach ($returnedPeminjaman as $pinjam) {
            // Use DB::table to avoid model issues
            DB::table('pengembalian')->insert([
                'peminjaman_id' => $pinjam->id,
                'tanggal_dikembalikan' => now()->subDays(1),
                'kondisi_setelah' => 'baik',
                'denda' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Sample data berhasil ditambahkan!');
        $this->command->info('📊 Total kategori: ' . Kategori::count());
        $this->command->info('🔧 Total alat: ' . Alat::count());
        $this->command->info('📋 Total peminjaman: ' . Peminjaman::count());
        $this->command->info('🔄 Total pengembalian: ' . DB::table('pengembalian')->count());
    }
}
