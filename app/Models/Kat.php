<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Kat belongs to many CMOs
    public function cmos()
    {
        return $this->belongsToMany(User::class, 'cmo_kats', 'kat_id', 'cmo_id');
    }
}
