@extends('layouts.admin')

@section('content')
<h3 class="mb-4">📅 Riwayat Absensi Saya</h3>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('karyawan.riwayat') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">🔍 Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('karyawan.riwayat') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($riwayat->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada data presensi pada periode ini.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Jam Kerja</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $key => $r)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ date('d-m-Y', strtotime($r->tanggal)) }}</td>
                            <td>{{ $r->jam_masuk }}</td>
                            <td>{{ $r->jam_keluar ?? '-' }}</td>
                            <td>{{ $r->jam_kerja ?? '-' }}</td>
                            <td>
                                @if($r->status == 'Telat')
                                    <span class="badge bg-danger">Telat</span>
                                @elseif($r->status == 'Tepat Waktu')
                                    <span class="badge bg-success">Tepat Waktu</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ $r->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection