<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;         // Tambahkan di atas
use App\Models\Dokter;
use App\Models\Poli;        // Tambahkan di atas

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokters = Dokter::with('poli')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'id_poli' => 'required|exists:polis,id',
        ]);

        // Buat data dokter baru
        $dokter = Dokter::create($request->all());

        // Buat data user baru untuk dokter tersebut
        User::create([
            'name' => $request->nama,
            'email' => str_replace(' ', '', strtolower($request->nama)) . '@gmail.com', // email dibuat otomatis
            'password' => Hash::make($request->alamat), // Alamat sebagai password
            'role' => 'dokter',
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'id_poli' => 'required|exists:polis,id',
        ]);

        // Temukan user yang berelasi dengan data dokter LAMA
        $user = User::where('name', $dokter->nama)->first();

        // Update data di tabel dokter
        $dokter->update($request->all());

        // Jika user ditemukan, update juga kredensialnya
        if ($user) {
            $user->update([
                'name' => $request->nama,
                'password' => Hash::make($request->alamat),
            ]);
        }

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        // Temukan dan hapus user yang berelasi
        // Kita gunakan nama sebagai acuan unik sementara ini
        $user = User::where('name', $dokter->nama)->first();
        if ($user) {
            $user->delete();
        }

        // Hapus data dokter
        $dokter->delete();

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
