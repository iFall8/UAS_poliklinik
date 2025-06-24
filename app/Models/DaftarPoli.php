<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DaftarPoli extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian',
    ];

    /**
     * Get the pasien that owns the DaftarPoli
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    /**
     * Get the jadwal that owns the DaftarPoli
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    /**
     * Get the periksa associated with the DaftarPoli
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function periksa(): HasOne
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }
}