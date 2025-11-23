@extends('layouts.admin')

@section('content')
<div class="card col-md-8 mx-auto shadow">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">✏️ Edit Data Karyawan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
            @csrf 
            @method('PUT') <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ $karyawan->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email Login</label>
                <input type="email" name="email" value="{{ $karyawan->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" name="jabatan" value="{{ $karyawan->jabatan }}" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="fw-bold">Hak Akses (Role)</label>
                <div class="alert alert-info py-2"><small>Admin bisa mengangkat Karyawan menjadi Admin baru di sini.</small></div>
                <select name="role" class="form-control">
                    <option value="karyawan" {{ $karyawan->role == 'karyawan' ? 'selected' : '' }}>Karyawan Biasa</option>
                    <option value="admin" {{ $karyawan->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
            </div>

            <hr>

            <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Isi hanya jika ingin mengganti password user">
                <small class="text-muted">Kosongkan jika password tidak ingin diubah.</small>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection