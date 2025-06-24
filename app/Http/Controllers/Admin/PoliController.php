<?php

namespace App\Http\Controllers\Admin;

use App\Models\Poli;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data poli dari database
        $polis = Poli::all();
        // Mengirim data poli ke view
        return view('admin.poli.index', compact('polis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.poli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Simpan data ke database
        Poli::create($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.poli.index')->with('success', 'Data poli berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poli $poli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poli $poli)
    {
        // Laravel secara otomatis akan menemukan data Poli berdasarkan ID di URL
        // Ini disebut "Route Model Binding", sangat efisien!
        return view('admin.poli.edit', compact('poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poli $poli)
    {
        // Validasi data
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        // Update data di database
        $poli->update($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.poli.index')->with('success', 'Data poli berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli)
    {
        // Hapus data
        $poli->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.poli.index')->with('success', 'Data poli berhasil dihapus.');
    }
}
