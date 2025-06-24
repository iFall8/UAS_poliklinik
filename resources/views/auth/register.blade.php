@extends('layouts.app_login') {{-- Kita akan buat layout ini --}}

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Poliklinik</b> BK</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Daftar sebagai pasien baru</p>

            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" name="nama" value="{{ old('nama') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
                    </div>
                     @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" placeholder="Nomor KTP" name="no_ktp" value="{{ old('no_ktp') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-id-card"></span></div>
                    </div>
                     @error('no_ktp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Nomor HP" name="no_hp" value="{{ old('no_hp') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                    </div>
                     @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-0 text-center">
                <a href="{{ route('login') }}" class="text-center">Saya sudah punya akun</a>
            </p>
        </div>
    </div>
</div>
@endsection