@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header"><h3 class="card-title">Edit Profil Saya</h3></div>
                <div class="card-body">
                    <form action="{{ route('dokter.profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $dokter->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat (berfungsi sebagai Password)</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $dokter->alamat }}" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $dokter->no_hp }}" required>
                        </div>
                        <div class="form-group">
                            <label>Poli</label>
                            <input type="text" class="form-control" value="{{ $dokter->poli->nama_poli }}" readonly>
                            <small class="form-text text-muted">Poli hanya bisa diubah oleh Admin.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection