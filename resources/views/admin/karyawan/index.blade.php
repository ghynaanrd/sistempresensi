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
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, var(--primary-medium), var(--primary-light));
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(30, 58, 95, 0.3);
    }
    
    .btn-warning-custom {
        background: linear-gradient(135deg, #8a6d3b, #b8943c);
        border: none;
        color: white;
    }
    
    .btn-danger-custom {
        background: linear-gradient(135deg, #8a3b3b, #b83c3c);
        border: none;
        color: white;
    }
    
    .btn-secondary-custom {
        background: linear-gradient(135deg, #4a5568, #718096);
        border: none;
        color: white;
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
    
    .badge-admin {
        background: linear-gradient(135deg, #8a3b3b, #b83c3c);
        color: white;
        padding: 0.4em 0.8em;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-karyawan {
        background: linear-gradient(135deg, var(--primary-medium), var(--primary-light));
        color: white;
        padding: 0.4em 0.8em;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
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
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 style="color: var(--primary-dark);">👥 Data Karyawan</h3>
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary-custom">
        + Tambah Karyawan
    </a>
</div>

@if(session('success'))
    <div class="alert alert-custom">{{ session('success') }}</div>
@endif

<div class="card card-custom shadow">
    <div class="card-body">
        
        <form action="{{ route('karyawan.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-custom" placeholder="Cari nama karyawan..." value="{{ request('search') }}">
                <button class="btn btn-secondary-custom" type="submit">🔍 Cari</button>
            </div>
        </form>

        <table class="table table-bordered table-striped table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Hak Akses</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawans as $key => $karyawan)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $karyawan->name }}</td>
                    <td>{{ $karyawan->email }}</td>
                    <td>{{ $karyawan->jabatan }}</td>
                    <td>
                        @if($karyawan->role == 'admin')
                            <span class="badge-admin">Admin</span>
                        @else
                            <span class="badge-karyawan">Karyawan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-warning-custom btn-sm">Edit</a>

                        <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger-custom btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection