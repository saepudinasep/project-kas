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
}
