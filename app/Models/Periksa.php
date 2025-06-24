<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tgl_periksa' => 'datetime', // <-- TAMBAHKAN BLOK KODE INI
    ];

    /**
     * Get the daftarPoli that owns the Periksa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function daftarPoli(): BelongsTo
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }

    /**
     * Get all of the detailPeriksas for the Periksa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPeriksas(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
}