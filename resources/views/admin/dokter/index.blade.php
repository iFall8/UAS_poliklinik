@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Dokter</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.dokter.create') }}" class="btn btn-sm btn-primary">Tambah Baru</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No. HP</th>
                                <th>Poli</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dokters as $dokter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dokter->nama }}</td>
                                    <td>{{ $dokter->no_hp }}</td>
                                    <td>{{ $dokter->poli->nama_poli }}</td>
                                    <td>
                                        <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data dokter ini beserta akun loginnya?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data kosong</td>
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