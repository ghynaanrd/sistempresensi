@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>📊 Rekapitulasi Absensi</h3>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.rekap') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label>Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label>Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.rekap') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status</th>
                    <th>Aksi</th> </tr>
            </thead>
            <tbody>
                @foreach($presensis as $key => $p)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{ $p->user->name }}<br>
                        <small class="text-muted">{{ $p->user->jabatan }}</small>
                    </td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->jam_masuk }}</td>
                    <td>{{ $p->jam_keluar }}</td>
                    <td>{{ $p->status }}</td>
                    <td>
                        <a href="{{ route('presensi.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('presensi.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection