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
    // public function cmos()
    // {
    //     return $this->belongsToMany(User::class, 'cmo_kats', 'kat_id', 'cmo_id');
    // }
    public function kats()
    {
        return $this->belongsToMany(Kat::class, 'cmo_kats', 'cmo_id', 'kat_id');
    }

    public function cmoUsers()
    {
        return $this->belongsToMany(User::class, 'cmo_kats');
    }

    // Definisikan relasi many-to-many dengan model CmoKat
    public function cmoKats()
    {
        return $this->belongsToMany(CmoKat::class, 'cmo_kats', 'kat_id', 'cmo_id');
    }
}
