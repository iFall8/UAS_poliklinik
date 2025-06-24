<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use Illuminate\Support\Facades\Auth;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\DetailPeriksa;

class PeriksaController extends Controller
{
    public function index()
    {
        $id_dokter = Auth::guard('dokter')->user()->id;

        // Mapping hari dari angka (format 'N' PHP) ke string
        $hari_map = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
        $hari_ini = $hari_map[date('N')];

        // Ambil jadwal dokter yang aktif pada hari ini
        $jadwal = JadwalPeriksa::where('id_dokter', $id_dokter)
                             ->where('hari', $hari_ini)
                             ->where('status', 1) // status 1 = Aktif
                             ->first();

        $daftar_polis = collect(); // Buat koleksi kosong sebagai default

        if ($jadwal) {
            // Jika ada jadwal hari ini, ambil daftar pasien yang mendaftar ke jadwal tsb
            // dan statusnya belum 'selesai'
            $daftar_polis = DaftarPoli::where('id_jadwal', $jadwal->id)
                                      ->with('pasien')
                                      ->whereDoesntHave('periksa')
                                      ->orderBy('no_antrian', 'asc')
                                      ->get();
        }

        return view('dokter.periksa.index', compact('daftar_polis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $daftar_poli = DaftarPoli::with('pasien')->findOrFail($id);
        $obats = Obat::all();

        // Variabel $riwayat_periksa sudah tidak dibutuhkan di sini lagi
        return view('dokter.periksa.edit', compact('daftar_poli', 'obats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat' => 'required|array',
        ]);

        // 1. Hitung total biaya obat
        $total_harga_obat = 0;
        foreach ($request->obat as $id_obat) {
            $obat = Obat::find($id_obat);
            $total_harga_obat += $obat->harga;
        }

        // 2. Hitung total biaya periksa (jasa dokter + obat)
        $biaya_periksa = 150000 + $total_harga_obat;

        // 3. Simpan data ke tabel 'periksa'
        $periksa = Periksa::create([
            'id_daftar_poli' => $id,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $biaya_periksa,
        ]);

        // 4. Simpan resep obat ke tabel 'detail_periksa'
        foreach ($request->obat as $id_obat) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $id_obat,
            ]);
        }

        // 5. Redirect kembali ke halaman antrean dengan pesan sukses
        return redirect()->route('dokter.periksa.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }
}