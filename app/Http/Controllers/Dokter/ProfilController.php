<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function edit()
    {
        // Ambil data dokter yang sedang login
        $dokter = Auth::guard('dokter')->user();
        return view('dokter.profil.edit', compact('dokter'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        $dokter = Auth::guard('dokter')->user();

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

        return redirect()->route('dokter.profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}