<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelatihan extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel di database
    protected $table = 'pelatihan';

    // Nama Primary Key (karena bukan 'id')
    protected $primaryKey = 'pelatihan_id';

    public $timestamps = false;

    /**
     * Kolom yang dapat diisi melalui form/request (Mass Assignment).
     * Disesuaikan dengan struktur tabel di gambar.
     */
    protected $fillable = [
        'pelatihan_name',
        'kategori_pelatihan_id',
        'syarat_id',
        'mentor_id',
        'pelatihan_silabus',
        'pelatihan_tatacara',
        'pelatihan_mulai',
        'pelatihan_tutup',
        'pelatihan_jadwal'
    ];

    /**
     * Kolom yang harus diperlakukan sebagai tanggal.
     * Ini akan otomatis dikonversi menjadi objek Carbon oleh Laravel.
     */
    protected $dates = ['deleted_at', 'pelatihan_mulai', 'pelatihan_tutup'];

    // Jika Anda tidak menggunakan kolom 'created_at' dan 'updated_at' bawaan Laravel
    // public $timestamps = false;
}
