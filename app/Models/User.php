<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User belongs to a role, so define the relation
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // User can belong to multiple branches
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'user_branches');
    }

    // CMO can have many Kats
    // public function kats()
    // {
    //     return $this->hasManyThrough(Kat::class, CmoKat::class, 'cmo_id', 'id', 'id', 'kat_id');
    // }
    public function cmoKats()
    {
        return $this->belongsToMany(Kat::class, 'cmo_kats');
    }

    // Relasi many-to-many dengan Kat
    public function kats(): BelongsToMany
    {
        return $this->belongsToMany(Kat::class, 'cmo_kats', 'cmo_id', 'kat_id');
    }
}
