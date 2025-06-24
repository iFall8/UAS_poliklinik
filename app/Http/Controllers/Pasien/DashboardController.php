<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPoli; // <-- Tambahkan ini
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pasien.dashboard');
    }

    public function riwayat()
    {
        // Ambil ID pasien yang sedang login
        $id_pasien = Auth::guard('pasien')->user()->id;

        // Ambil semua data pendaftaran milik pasien tersebut
        $riwayat_pendaftaran = DaftarPoli::where('id_pasien', $id_pasien)
                                          // Ambil relasi jadwal->dokter->poli DAN periksa->detailPeriksas->obat
                                          ->with(['jadwal.dokter.poli', 'periksa.detailPeriksas.obat'])
                                          ->orderBy('created_at', 'desc')
                                          ->get();

        return view('pasien.riwayat', compact('riwayat_pendaftaran'));
    }
}
