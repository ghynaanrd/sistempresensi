@extends('layouts.admin')

@section('content')
<style>
    :root {
        --primary-dark: #1e3a5f;  /* Biru dongker */
        --primary-medium: #2c5282; /* Biru sedang */
        --primary-light: #4a7bbe;  /* Biru terang */
        --cream-bg: #f8f4e9;       /* Cream untuk background */
        --cream-card: #fffbf0;     /* Cream lebih terang untuk kartu */
        --accent-gold: #d4af37;    /* Emas untuk aksen */
    }
    
    .card-custom {
        background: var(--cream-card);
        border: 1px solid rgba(30, 58, 95, 0.1);
        border-radius: 10px;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, var(--primary-medium), var(--primary-light));
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(30, 58, 95, 0.3);
    }
    
    .btn-secondary-custom {
        background: linear-gradient(135deg, #4a5568, #718096);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .form-control-custom {
        border: 2px solid rgba(30, 58, 95, 0.1);
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control-custom:focus {
        border-color: var(--primary-medium);
        box-shadow: 0 0 0 0.2rem rgba(44, 82, 130, 0.15);
    }
    
    .table-custom {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .table-custom thead {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
        color: white;
    }
    
    .table-custom th {
        border: none;
        padding: 12px 15px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .table-custom td {
        padding: 12px 15px;
        border-color: rgba(30, 58, 95, 0.1);
        vertical-align: middle;
    }
    
    .table-custom tbody tr:hover {
        background-color: rgba(30, 58, 95, 0.03);
    }
    
    .badge-tepat-waktu {
        background: linear-gradient(135deg, #2d5a2d, #3a7a3a);
        color: white;
        padding: 0.4em 0.8em;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-telat {
        background: linear-gradient(135deg, #8a3b3b, #b83c3c);
        color: white;
        padding: 0.4em 0.8em;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-lainnya {
        background: linear-gradient(135deg, #8a6d3b, #b8943c);
        color: white;
        padding: 0.4em 0.8em;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .alert-info-custom {
        background: rgba(30, 58, 95, 0.1);
        border: 1px solid var(--primary-medium);
        border-left: 4px solid var(--primary-medium);
        color: var(--primary-dark);
        border-radius: 8px;
    }
    
    .form-label-custom {
        color: var(--primary-dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
</style>

<h3 class="mb-4" style="color: var(--primary-dark);">📅 Riwayat Absensi Saya</h3>

<div class="card card-custom shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('karyawan.riwayat') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label-custom">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control form-control-custom" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label-custom">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control form-control-custom" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-custom w-100">🔍 Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('karyawan.riwayat') }}" class="btn btn-secondary-custom w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card card-custom shadow">
    <div class="card-body">
        @if($riwayat->isEmpty())
            <div class="alert alert-info-custom text-center">
                Belum ada data presensi pada periode ini.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-custom">
                    <thead>
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
                            <td>
                                @if($r->jam_masuk)
                                    <span class="text-success fw-bold">{{ $r->jam_masuk }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($r->jam_keluar)
                                    <span class="text-warning fw-bold">{{ $r->jam_keluar }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($r->jam_kerja)
                                    <span class="text-primary fw-bold">{{ $r->jam_kerja }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($r->status == 'Telat')
                                    <span class="badge-telat">Telat</span>
                                @elseif($r->status == 'Tepat Waktu')
                                    <span class="badge-tepat-waktu">Tepat Waktu</span>
                                @else
                                    <span class="badge-lainnya">{{ $r->status }}</span>
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