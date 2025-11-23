@extends('layouts.admin')

@section('content')
<div class="card shadow col-md-8 mx-auto">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Karyawan Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('karyawan.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required placeholder="Contoh: Siti Aminah">
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" required placeholder="Contoh: Staff Keuangan">
            </div>

            <div class="mb-3">
                <label>Email (Untuk Login)</label>
                <input type="email" name="email" class="form-control" required placeholder="email@kantor.com">
            </div>

            <div class="mb-3">
                <label>Password Default</label>
                <input type="text" name="password" class="form-control" value="password123" required>
                <small class="text-muted">Bisa diganti user nanti, tapi kita set default dulu.</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection