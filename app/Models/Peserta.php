<?php

namespace App\Models;

// WAJIB: Gunakan Authenticatable, bukan Model
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Peserta extends Authenticatable 
{
    use Notifiable;

    protected $table = 'peserta';
    protected $primaryKey = 'peserta_id';

    protected $fillable = [
        'peserta_name', 'peserta_email','peserta_google_id', 'peserta_password', 'usertype'
    ];

    // Beritahu Laravel kolom passwordnya
    public function getAuthPassword()
    {
        return $this->peserta_password;
    }
}