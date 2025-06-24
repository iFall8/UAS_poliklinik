@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Pasien</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pasien.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>No. KTP</label>
                    <input type="text" name="no_ktp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection