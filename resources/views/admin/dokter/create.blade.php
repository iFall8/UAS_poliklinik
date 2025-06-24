@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Dokter</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dokter.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Dokter</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="id_poli">Poli</label>
                            <select name="id_poli" class="form-control" required>
                                <option value="">Pilih Poli</option>
                                @foreach ($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection