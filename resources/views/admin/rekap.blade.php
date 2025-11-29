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
    
    .btn-warning-custom {
        background: linear-gradient(135deg, #8a6d3b, #b8943c);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-danger-custom {
        background: linear-gradient(135deg, #8a3b3b, #b83c3c);
        border: none;
        color: white;
        transition: all 0.3s ease;
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
    
    .alert-custom {
        background: rgba(30, 58, 95, 0.1);
        border: 1px solid var(--primary-medium);
        border-left: 4px solid var(--primary-medium);
        color: var(--primary-dark);
        border-radius: 8px;
        padding: 1rem;
    }
    
    .status-badge {
        padding: 0.3em 0.8em;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    
    .status-hadir {
        background: linear-gradient(135deg, #2d5a2d, #3a7a3a);
        color: white;
    }
    
    .status-terlambat {
        background: linear-gradient(135deg, #8a6d3b, #b8943c);
        color: white;
    }
    
    .status-cuti {
        background: linear-gradient(135deg, #4a5568, #718096);
        color: white;
    }
    
    .status-izin {
        background: linear-gradient(135deg, #1e4a5f, #2c6a82);
        color: white;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 style="color: var(--primary-dark);">📊 Rekapitulasi Absensi</h3>
</div>

<div class="card card-custom shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.rekap') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label style="color: var(--primary-dark); font-weight: 600;">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control form-control-custom" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label style="color: var(--primary-dark); font-weight: 600;">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control form-control-custom" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-custom w-100">Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.rekap') }}" class="btn btn-secondary-custom w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-custom">{{ session('success') }}</div>
@endif

<div class="card card-custom shadow">
    <div class="card-body">
        <table class="table table-bordered table-striped table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($presensis as $key => $p)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <strong>{{ $p->user->name }}</strong><br>
                        <small class="text-muted">{{ $p->user->jabatan }}</small>
                    </td>
                    <td>{{ $p->tanggal }}</td>
                    <td>
                        @if($p->jam_masuk)
                            <span class="text-success">{{ $p->jam_masuk }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($p->jam_keluar)
                            <span class="text-warning">{{ $p->jam_keluar }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $statusClass = 'status-hadir';
                            if(strpos(strtolower($p->status), 'terlambat') !== false) {
                                $statusClass = 'status-terlambat';
                            } elseif(strpos(strtolower($p->status), 'cuti') !== false) {
                                $statusClass = 'status-cuti';
                            } elseif(strpos(strtolower($p->status), 'izin') !== false) {
                                $statusClass = 'status-izin';
                            }
                        @endphp
                        <span class="status-badge {{ $statusClass }}">{{ $p->status }}</span>
                    </td>
                    <td>
                        <a href="{{ route('presensi.edit', $p->id) }}" class="btn btn-warning-custom btn-sm">Edit</a>
                        
                        <form action="{{ route('presensi.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger-custom btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection