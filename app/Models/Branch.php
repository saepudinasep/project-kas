<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan model ini
    protected $table = 'branches';

    // Jika ada atribut lain yang ingin diatur, seperti fillable:
    protected $fillable = ['name', 'region_id'];
}
