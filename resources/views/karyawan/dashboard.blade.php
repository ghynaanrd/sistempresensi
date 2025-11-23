@extends('layouts.admin') 
@section('content')
<div class="text-center mt-5">
    <h3>Halo, {{ Auth::user()->name }}!</h3>
    <p class="text-muted">{{ date('l, d F Y') }}</p>

    @if(session('success'))
        <div class="alert alert-success col-md-6 mx-auto">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger col-md-6 mx-auto">{{ session('error') }}</div>
    @endif

    <div class="card shadow col-md-6 mx-auto mt-4">
        <div class="card-body py-5">
            
            @if($presensi == null)
                <h5 class="mb-4">Silakan Absen Masuk</h5>
                <form action="{{ route('presensi.store') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-lg w-50">
                        🕒 TEKAN UNTUK MASUK
                    </button>
                </form>

            @elseif($presensi->jam_keluar == null)
                <h5 class="mb-3">Anda sudah masuk jam: <span class="badge bg-info">{{ $presensi->jam_masuk }}</span></h5>
                <p>Status: <strong>{{ $presensi->status }}</strong></p>
                
                <hr>
                <p class="text-muted">Pekerjaan hari ini sudah selesai?</p>
                
                <form action="{{ route('presensi.pulang') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-lg w-50" onclick="return confirm('Yakin ingin pulang?')">
                        🏠 TEKAN UNTUK PULANG
                    </button>
                </form>
            
            
            @else
                <h5 class="text-success">Absensi Hari Ini Selesai! ✅</h5>
                <p>Masuk: {{ $presensi->jam_masuk }} | Pulang: {{ $presensi->jam_keluar }}</p>
            @endif

        </div>
    </div>
</div>
@endsection