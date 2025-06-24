<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::with('dokter.poli')->where('status', true)->get();
        return view('pasien.poli.index', compact('jadwals'));
    }

    public function daftar(Request $request)
    {
        $request->validate([
            
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string',
        ]);

        // Generate nomor antrian
        $nomorAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count() + 1;

        DaftarPoli::create([
            'id_pasien' => Auth::guard('pasien')->user()->id,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $nomorAntrian,
        ]);

        return redirect()->route('pasien.poli.index')->with('success', 'Berhasil mendaftar poli. Nomor antrian Anda adalah ' . $nomorAntrian);
    }
}