@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Riwayat Pendaftaran Poli</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>No. Antrian</th>
                        <th>Status</th>
                        <th>Aksi</th> </tr>
                </thead>
                <tbody>
                    @forelse ($riwayat_pendaftaran as $pendaftaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pendaftaran->jadwal->dokter->poli->nama_poli }}</td>
                            <td>{{ $pendaftaran->jadwal->dokter->nama }}</td>
                            <td>{{ $pendaftaran->jadwal->hari }}</td>
                            <td>{{ $pendaftaran->jadwal->jam_mulai }} - {{ $pendaftaran->jadwal->jam_selesai }}</td>
                            <td>{{ $pendaftaran->no_antrian }}</td>
                            <td>
                                @if($pendaftaran->periksa)
                                    <span class="badge badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-warning">Belum Diperiksa</span>
                                @endif
                            </td>
                            <td>
                                @if($pendaftaran->periksa)
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-detail-{{ $pendaftaran->id }}">
                                        Detail
                                    </button>
                                @endif
                            </td>
                        </tr>

                        @if($pendaftaran->periksa)
                        <div class="modal fade" id="modal-detail-{{ $pendaftaran->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalDetailLabel">Detail Pemeriksaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Tanggal Periksa:</strong><br> {{ $pendaftaran->periksa->tgl_periksa->format('d F Y, H:i') }}</p>
                                        <p><strong>Diagnosis:</strong><br> {{ $pendaftaran->periksa->catatan }}</p>
                                        <p><strong>Obat yang Diberikan:</strong></p>
                                        <ul>
                                            @foreach($pendaftaran->periksa->detailPeriksas as $detail)
                                                <li>{{ $detail->obat->nama_obat }} ({{ $detail->obat->kemasan }})</li>
                                            @endforeach
                                        </ul>
                                        <h6 class="mt-3"><strong>Total Biaya: Rp {{ number_format($pendaftaran->periksa->biaya_periksa, 0, ',', '.') }}</strong></h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Anda belum memiliki riwayat pendaftaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection