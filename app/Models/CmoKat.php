<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmoKat extends Model
{
    use HasFactory;

    protected $fillable = [
        'cmo_id',
        'kat_id',
    ];

    // Definisikan relasi dengan model Kat
    public function kat()
    {
        return $this->belongsTo(Kat::class, 'kat_id');
    }

    // Definisikan relasi dengan model User (CMO)
    public function cmo()
    {
        return $this->belongsTo(User::class, 'cmo_id');
    }
}
