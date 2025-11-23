@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>👥 Data Karyawan</h3>
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
        + Tambah Karyawan
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow">
    <div class="card-body">
        
        <form action="{{ route('karyawan.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama karyawan..." value="{{ request('search') }}">
                <button class="btn btn-secondary" type="submit">🔍 Cari</button>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Hak Akses</th> <th>Aksi</th>
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
                            <span class="badge bg-danger">Admin</span>
                        @else
                            <span class="badge bg-info">Karyawan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection