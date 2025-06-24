<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil jadwal hanya untuk dokter yang sedang login
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::guard('dokter')->user()->id)
                                ->orderBy('hari', 'asc')
                                ->get();
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // STANDARDISASI INPUT WAKTU
        if ($request->has('jam_mulai') && strlen($request->jam_mulai) == 5) {
            $request->merge(['jam_mulai' => $request->jam_mulai . ':00']);
        }
        if ($request->has('jam_selesai') && strlen($request->jam_selesai) == 5) {
            $request->merge(['jam_selesai' => $request->jam_selesai . ':00']);
        }

        // VALIDASI (tetap menggunakan H:i:s karena input sudah kita standarkan)
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
        ], [
            'hari.required' => 'Hari harus dipilih.',
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'jam_mulai.date_format' => 'Format jam mulai tidak valid.',
            'jam_selesai.required' => 'Jam selesai harus diisi.',
            'jam_selesai.date_format' => 'Format jam selesai tidak valid.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
        ]);

        // Sisa kode store biarkan sama...
        $id_dokter = Auth::guard('dokter')->user()->id;

        $jadwalExists = JadwalPeriksa::where('id_dokter', $id_dokter)
                                    ->where('hari', $request->hari)
                                    ->exists();

        if ($jadwalExists) {
            return redirect()->route('dokter.jadwal.index')->with('error', 'Jadwal pada hari yang sama sudah ada.');
        }

        JadwalPeriksa::create([
            'id_dokter' => $id_dokter,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 0,
        ]);

        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalPeriksa $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPeriksa $jadwal)
    {
        // Pastikan dokter hanya bisa mengedit jadwal miliknya sendiri
        if ($jadwal->id_dokter != Auth::guard('dokter')->user()->id) {
            abort(403);
        }
        return view('dokter.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPeriksa $jadwal)
    {
        // Pastikan dokter hanya bisa mengedit jadwal miliknya sendiri
        if ($jadwal->id_dokter != Auth::guard('dokter')->user()->id) {
            abort(403);
        }

        // STANDARDISASI INPUT WAKTU
        if ($request->has('jam_mulai') && strlen($request->jam_mulai) == 5) {
            $request->merge(['jam_mulai' => $request->jam_mulai . ':00']);
        }
        if ($request->has('jam_selesai') && strlen($request->jam_selesai) == 5) {
            $request->merge(['jam_selesai' => $request->jam_selesai . ':00']);
        }

        // VALIDASI (tetap menggunakan H:i:s)
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
            'status' => 'required|in:0,1',
        ], [
            // ... pesan error custom biarkan sama ...
        ]);

        // Sisa kode update biarkan sama...
        $id_dokter = Auth::guard('dokter')->user()->id;
        $status_baru = $request->status;

        if ($status_baru == 1) {
            JadwalPeriksa::where('id_dokter', $id_dokter)
                        ->where('id', '!=', $jadwal->id)
                        ->update(['status' => 0]);
        }

        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $status_baru,
        ]);

        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPeriksa $jadwal)
    {
        // Pastikan dokter hanya bisa menghapus jadwal miliknya sendiri
        if ($jadwal->id_dokter != Auth::guard('dokter')->user()->id) {
            abort(403);
        }

        if ($jadwal->daftarPolis()->exists()) {
            return redirect()->route('dokter.jadwal.index')->with('error', 'Jadwal tidak dapat dihapus karena sudah ada pasien yang terdaftar.');
        }

        $jadwal->delete();
        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}