@extends('layouts.app')

@section('content')
<div class="container">
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
            <h3 class="card-title">Data Pasien</h3>
            <div class="card-tools">
                <a href="{{ route('admin.pasien.create') }}" class="btn btn-sm btn-primary">Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. RM</th>
                        <th>No. KTP</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pasiens as $pasien)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->no_rm }}</td>
                            <td>{{ $pasien->no_ktp }}</td>
                            <td>{{ $pasien->no_hp }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>
                                <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data pasien ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection