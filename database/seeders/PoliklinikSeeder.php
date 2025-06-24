<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;

class PoliklinikSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 1 poli dulu sebagai contoh
        $poli = Poli::create(['nama_poli' => 'Umum', 'keterangan' => 'Poli untuk penyakit umum']);

        // Buat data Dokter
        Dokter::create([
            'nama' => 'Dr. Budi',
            'alamat' => 'Jalan Sehat No. 10',
            'no_hp' => '081234567890',
            'id_poli' => $poli->id,
        ]);

        // Buat data Pasien
        Pasien::create([
            'nama' => 'Siti Pasien',
            'alamat' => 'Jalan Sakit No. 5',
            'no_ktp' => '1234567890123456',
            'no_hp' => '089876543210',
            'no_rm' => '202506-001',
        ]);
    }
}