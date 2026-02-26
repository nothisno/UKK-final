<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengembalian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengembalian'; // Sesuaikan dengan nama tabel di migration

    protected $fillable = [
        'peminjaman_id',
        'tanggal_dikembalikan',
        'kondisi_setelah',
        'denda',
        'denda_keterlambatan',
        'denda_kerusakan',
        'total_denda',
        'status_denda',
        'catatan',
    ];

    protected $casts = [
        'tanggal_dikembalikan' => 'date',
        'denda' => 'decimal:2',
        'denda_keterlambatan' => 'decimal:2',
        'denda_kerusakan' => 'decimal:2',
        'total_denda' => 'decimal:2',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
