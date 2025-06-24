<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::all();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|unique:pasiens,no_ktp',
            'no_hp' => 'required|string',
        ]);

        // Generate No. Rekam Medis
        $lastPatient = Pasien::orderBy('id', 'desc')->first();
        $lastPatientId = $lastPatient ? $lastPatient->id : 0;
        $no_rm = date('Ym') . '-' . str_pad($lastPatientId + 1, 3, '0', STR_PAD_LEFT);

        $data = $request->all();
        $data['no_rm'] = $no_rm;

        Pasien::create($data);

        User::create([
            'name' => $request->nama,
            'email' => str_replace(' ', '', strtolower($request->nama)) . '_pasien@gmail.com', // email dibuat otomatis
            'password' => Hash::make($request->alamat), // Alamat sebagai password
            'role' => 'pasien',
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function edit(Pasien $pasien)
    {
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|unique:pasiens,no_ktp,' . $pasien->id,
            'no_hp' => 'required|string',
        ]);

        $user = User::where('name', $pasien->nama)->first();

        $pasien->update($request->all());

        if ($user) {
            $user->update([
                'name' => $request->nama,
                'password' => Hash::make($request->alamat),
            ]);
        }

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $user = User::where('name', $pasien->nama)->first();
        if ($user) {
            $user->delete();
        }

        $pasien->delete();

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}