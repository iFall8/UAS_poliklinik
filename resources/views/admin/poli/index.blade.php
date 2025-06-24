@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Poli</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.poli.create') }}" class="btn btn-sm btn-primary">Tambah Baru</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Nama Poli</th>
                                <th>Keterangan</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($polis as $poli)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $poli->nama_poli }}</td>
                                    <td>{{ $poli->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection