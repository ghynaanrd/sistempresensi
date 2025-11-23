@extends('layouts.admin')

@section('content')
<div class="card col-md-6 mx-auto shadow">
    <div class="card-header bg-warning">
        Edit Presensi: <strong>{{ $presensi->user->name }}</strong>
    </div>
    <div class="card-body">
        <form action="{{ route('presensi.update', $presensi->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="text" class="form-control" value="{{ $presensi->tanggal }}" readonly>
            </div>

            <div class="mb-3">
                <label>Jam Masuk</label>
                <input type="time" name="jam_masuk" class="form-control" value="{{ $presensi->jam_masuk }}">
            </div>

            <div class="mb-3">
                <label>Jam Pulang</label>
                <input type="time" name="jam_keluar" class="form-control" value="{{ $presensi->jam_keluar }}">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Tepat Waktu" {{ $presensi->status == 'Tepat Waktu' ? 'selected' : '' }}>Tepat Waktu</option>
                    <option value="Telat" {{ $presensi->status == 'Telat' ? 'selected' : '' }}>Telat</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.rekap') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection