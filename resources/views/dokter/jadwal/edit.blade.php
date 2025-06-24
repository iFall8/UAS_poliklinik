@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Edit Jadwal Periksa</h3></div>
        <div class="card-body">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('dokter.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <select name="hari" class="form-control" required>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                            <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1" {{ $jadwal->status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $jadwal->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection