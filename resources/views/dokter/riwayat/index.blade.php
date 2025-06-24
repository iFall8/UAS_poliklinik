@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Riwayat Pasien</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Periksa</th>
                        <th>Keluhan</th>
                        <th>Catatan/Diagnosis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayat_pemeriksaan as $periksa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $periksa->daftarPoli->pasien->nama }}</td>
                            <td>{{ $periksa->tgl_periksa->format('d F Y') }}</td>
                            <td>{{ $periksa->daftarPoli->keluhan }}</td>
                            <td>{{ $periksa->catatan }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-detail-{{ $periksa->id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="modal-detail-{{ $periksa->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalDetailLabel">Detail Pemeriksaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6><strong>Pasien:</strong> {{ $periksa->daftarPoli->pasien->nama }}</h6>
                                        <hr>
                                        <p><strong>Tanggal Periksa:</strong><br> {{ $periksa->tgl_periksa->format('d F Y, H:i') }}</p>
                                        <p><strong>Keluhan:</strong><br> {{ $periksa->daftarPoli->keluhan }}</p>
                                        <p><strong>Diagnosis:</strong><br> {{ $periksa->catatan }}</p>
                                        <p><strong>Obat yang Diberikan:</strong></p>
                                        <ul>
                                            @foreach($periksa->detailPeriksas as $detail)
                                                <li>{{ $detail->obat->nama_obat }} ({{ $detail->obat->kemasan }})</li>
                                            @endforeach
                                        </ul>
                                        <h6 class="mt-3"><strong>Total Biaya: Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</strong></h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada riwayat pasien.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection