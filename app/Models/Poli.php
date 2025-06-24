<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    /**
     * Get all of the dokters for the Poli
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dokters(): HasMany
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }
}