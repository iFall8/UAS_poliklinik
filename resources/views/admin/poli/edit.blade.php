@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Poli</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.poli.update', $poli->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="form-group">
                            <label for="nama_poli">Nama Poli</label>
                            <input type="text" name="nama_poli" class="form-control" value="{{ $poli->nama_poli }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3" required>{{ $poli->keterangan }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection