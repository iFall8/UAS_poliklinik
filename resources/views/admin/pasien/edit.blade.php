@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Data Pasien</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" class="form-control" value="{{ $pasien->nama }}" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $pasien->alamat }}" required>
                </div>
                <div class="form-group">
                    <label>No. KTP</label>
                    <input type="text" name="no_ktp" class="form-control" value="{{ $pasien->no_ktp }}" required>
                </div>
                <div class="form-group">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $pasien->no_hp }}" required>
                </div>
                <div class="form-group">
                    <label>No. Rekam Medis</label>
                    <input type="text" name="no_rm" class="form-control" value="{{ $pasien->no_rm }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection