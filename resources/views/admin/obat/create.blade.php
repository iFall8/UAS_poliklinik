@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Obat</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.obat.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" name="nama_obat" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="kemasan">Kemasan</label>
                    <input type="text" name="kemasan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection