<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $id_dokter = Auth::guard('dokter')->user()->id;
        $riwayat_pemeriksaan = Periksa::whereHas('daftarPoli.jadwal', function ($query) use ($id_dokter) {
            $query->where('id_dokter', $id_dokter);
        })
        ->with(['daftarPoli.pasien', 'detailPeriksas.obat'])
        ->orderBy('tgl_periksa', 'desc')->get();

        return view('dokter.riwayat.index', compact('riwayat_pemeriksaan'));
    }
}