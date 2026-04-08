<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table = 'users'; // Sesuaikan dengan nama tabel admin kamu
    protected $fillable = ['name', 'email', 'password'];
}
