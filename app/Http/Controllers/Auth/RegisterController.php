<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi.
     */
    public function register(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|size:16|unique:pasiens,no_ktp',
            'no_hp' => 'required|string|max:15',
        ]);

        // 2. Buat No. RM terlebih dahulu
        // Ambil data pasien terakhir untuk menentukan ID berikutnya
        $lastPatient = Pasien::orderBy('id', 'desc')->first();
        $lastPatientId = $lastPatient ? $lastPatient->id : 0;
        $no_rm = date('Ym') . '-' . str_pad($lastPatientId + 1, 3, '0', STR_PAD_LEFT);

        // 3. Siapkan semua data untuk disimpan
        $dataToCreate = $request->all();
        $dataToCreate['no_rm'] = $no_rm;

        // 4. Buat data Pasien baru dengan No. RM yang sudah siap
        $pasien = Pasien::create($dataToCreate);

        // 5. Buat data User baru untuk login
        $user = User::create([
            'name' => $request->nama,
            'password' => Hash::make($request->alamat), // Alamat sebagai password
            'role' => 'pasien',
            'email' => str_replace(' ', '', strtolower($request->nama)) . '_pasien@gmail.com',
        ]);

        // 6. Login-kan pengguna secara otomatis
        Auth::guard('pasien')->login($pasien);

        // 7. Redirect ke dashboard pasien
        return redirect()->route('pasien.dashboard')->with('success', 'Pendaftaran berhasil! Anda sekarang sudah login.');
    }
}