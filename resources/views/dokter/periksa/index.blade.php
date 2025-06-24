@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Antrean Pasien</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftar_polis as $daftar)
                        <tr>
                            <td>{{ $daftar->no_antrian }}</td>
                            <td>{{ $daftar->pasien->nama }}</td>
                            <td>{{ $daftar->keluhan }}</td>
                            <td>
                                <a href="{{ route('dokter.periksa.edit', $daftar->id) }}" class="btn btn-sm btn-primary">Periksa</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Tidak ada pasien dalam antrean saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection