<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
    ];

    /**
     * Get all of the daftarPolis for the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function daftarPolis(): HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }
}