<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect($this->getRedirectPath());
        }
        return view('auth.login');
    }

    /**
     * Menangani percobaan login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string',
            'alamat' => 'required|string',
        ]);

        // Coba login sebagai Admin terlebih dahulu
        $adminCredentials = ['email' => $request->nama, 'password' => $request->alamat];
        if (Auth::guard('web')->attempt($adminCredentials)) {
            $request->session()->regenerate();
            return redirect()->intended($this->getRedirectPath());
        }

        // Jika gagal, coba login sebagai Dokter
        $dokter = \App\Models\Dokter::where('nama', $request->nama)->first();
        if ($dokter && $dokter->alamat == $request->alamat) {
            Auth::guard('dokter')->login($dokter);
            $request->session()->regenerate();
            return redirect()->intended($this->getRedirectPath());
        }

        // Jika masih gagal, coba login sebagai Pasien
        $pasien = \App\Models\Pasien::where('nama', $request->nama)->first();
        if ($pasien && $pasien->alamat == $request->alamat) {
            Auth::guard('pasien')->login($pasien);
            $request->session()->regenerate();
            return redirect()->intended($this->getRedirectPath());
        }

        // Jika semua percobaan gagal, kembalikan dengan pesan error
        return back()->withErrors(['nama' => 'Nama atau Alamat/Password tidak cocok.'])->onlyInput('nama');
    }

    /**
     * Menentukan path redirect setelah login berhasil.
     */
    protected function getRedirectPath()
    {
        // Periksa guard mana yang sedang aktif
        if (Auth::guard('web')->check()) {
            // Untuk Admin
            return '/admin/dashboard';
        } elseif (Auth::guard('dokter')->check()) {
            // Untuk Dokter
            return '/dokter/dashboard';
        } elseif (Auth::guard('pasien')->check()) {
            // Untuk Pasien
            return '/pasien/dashboard';
        }

        // Default fallback jika tidak ada guard yang aktif (seharusnya tidak terjadi)
        return '/login';
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        // Logout dari semua guard yang mungkin aktif
        Auth::guard('web')->logout();
        Auth::guard('dokter')->logout();
        Auth::guard('pasien')->logout();    

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}