@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Form Pemeriksaan Pasien</h3></div>
        <div class="card-body">
            <form action="{{ route('dokter.periksa.update', $daftar_poli->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" class="form-control" value="{{ $daftar_poli->pasien->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label>Keluhan</label>
                    <textarea class="form-control" rows="3" readonly>{{ $daftar_poli->keluhan }}</textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label for="tgl_periksa">Tanggal Periksa</label>
                    <input type="datetime-local" name="tgl_periksa" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan / Diagnosis</label>
                    <textarea name="catatan" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="obat">Obat</label>
                    <select name="obat[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Obat" style="width: 100%;" required>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">{{ $obat->nama_obat }} - (Rp {{ number_format($obat->harga, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <h5>Rincian Biaya</h5>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Jasa Dokter</label>
                        <input type="text" id="biaya_jasa" class="form-control" value="Rp {{ number_format(150000, 0, ',', '.') }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total Harga Obat</label>
                        <input type="text" id="total_harga_obat" class="form-control" value="Rp 0" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total Bayar</label>
                        <input type="text" id="total_biaya_periksa" class="form-control" value="Rp {{ number_format(150000, 0, ',', '.') }}" readonly>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Hasil Pemeriksaan</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        // Fungsi untuk menghitung total biaya
        function calculateTotal() {
            const biayaJasa = 150000;
            let totalHargaObat = 0;

            // Ambil semua pilihan obat yang dipilih
            $('.select2 option:selected').each(function() {
                // Tambahkan harga dari atribut data-harga
                totalHargaObat += parseFloat($(this).data('harga'));
            });

            let totalBiaya = biayaJasa + totalHargaObat;

            // Tampilkan hasil dengan format Rupiah
            // toLocaleString('id-ID') akan otomatis menambahkan titik ribuan
            $('#biaya_jasa').val('Rp ' + biayaJasa.toLocaleString('id-ID'));
            $('#total_harga_obat').val('Rp ' + totalHargaObat.toLocaleString('id-ID'));
            $('#total_biaya_periksa').val('Rp ' + totalBiaya.toLocaleString('id-ID'));
        }

        // Panggil fungsi saat ada perubahan pada pilihan obat
        $('.select2').on('change', function() {
            calculateTotal();
        });
    });
</script>
@endpush