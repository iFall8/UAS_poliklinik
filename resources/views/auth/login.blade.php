@extends('layouts.app_login')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Poliklinik</b> BK</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Login untuk memulai sesi Anda</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nama" name="nama" required value="{{ old('nama') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="alamat" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            @if($errors->any())
                <div class="alert alert-danger mt-3 mb-0">
                    {{ $errors->first() }}
                </div>
            @endif

            <p class="mb-0 mt-3 text-center">
                <a href="{{ route('register') }}" class="text-center">Daftar sebagai pasien baru</a>
            </p>
        </div>
        </div>
</div>
@endsection