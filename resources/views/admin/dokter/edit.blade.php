@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Dokter</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama Dokter</label>
                            <input type="text" name="nama" class="form-control" value="{{ $dokter->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ $dokter->alamat }}" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $dokter->no_hp }}" required>
                        </div>
                        <div class="form-group">
                            <label for="id_poli">Poli</label>
                            <select name="id_poli" class="form-control" required>
                                <option value="">Pilih Poli</option>
                                @foreach ($polis as $poli)
                                    <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>
                                        {{ $poli->nama_poli }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection