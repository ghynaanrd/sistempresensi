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
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(30, 58, 95, 0.1);
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
        border: none;
        color: white;
        border-radius: 10px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(30, 58, 95, 0.3);
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, var(--primary-medium), var(--primary-light));
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30, 58, 95, 0.4);
    }
    
    .btn-danger-custom {
        background: linear-gradient(135deg, #8a3b3b, #b83c3c);
        border: none;
        color: white;
        border-radius: 10px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(138, 59, 59, 0.3);
    }
    
    .btn-danger-custom:hover {
        background: linear-gradient(135deg, #b83c3c, #d45a5a);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(138, 59, 59, 0.4);
    }
    
    .badge-custom {
        background: linear-gradient(135deg, var(--primary-medium), var(--primary-light));
        color: white;
        padding: 0.5em 1em;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .alert-custom-success {
        background: rgba(45, 90, 45, 0.1);
        border: 1px solid #2d5a2d;
        border-left: 4px solid #2d5a2d;
        color: #2d5a2d;
        border-radius: 10px;
    }
    
    .alert-custom-danger {
        background: rgba(138, 59, 59, 0.1);
        border: 1px solid #8a3b3b;
        border-left: 4px solid #8a3b3b;
        color: #8a3b3b;
        border-radius: 10px;
    }
    
    .text-primary-custom {
        color: var(--primary-dark) !important;
    }
    
    .text-muted-custom {
        color: #6b7280 !important;
    }
    
    .hr-custom {
        border: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(30, 58, 95, 0.3), transparent);
        margin: 1.5rem 0;
    }
</style>

<div class="text-center mt-5">
    <h3 style="color: var(--primary-dark);">Halo, {{ Auth::user()->name }}!</h3>
    <p class="text-muted-custom">{{ date('l, d F Y') }}</p>

    @if(session('success'))
        <div class="alert alert-custom-success col-md-6 mx-auto">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-custom-danger col-md-6 mx-auto">{{ session('error') }}</div>
    @endif

    <div class="card card-custom col-md-6 mx-auto mt-4">
        <div class="card-body py-5">
            
            @if($presensi == null)
                <h5 class="mb-4" style="color: var(--primary-dark);">Silakan Absen Masuk</h5>
                <form action="{{ route('presensi.store') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary-custom w-75">
                        🕒 TEKAN UNTUK MASUK
                    </button>
                </form>

            @elseif($presensi->jam_keluar == null)
                <h5 class="mb-3" style="color: var(--primary-dark);">Anda sudah masuk jam: <span class="badge-custom">{{ $presensi->jam_masuk }}</span></h5>
                <p style="color: var(--primary-dark);">Status: <strong>{{ $presensi->status }}</strong></p>
                
                <div class="hr-custom"></div>
                <p class="text-muted-custom">Pekerjaan hari ini sudah selesai?</p>
                
                <form action="{{ route('presensi.pulang') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger-custom w-75" onclick="return confirm('Yakin ingin pulang?')">
                        🏠 TEKAN UNTUK PULANG
                    </button>
                </form>
            
            @else
                <h5 class="text-success mb-4">Absensi Hari Ini Selesai! ✅</h5>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-primary-custom">Masuk</h6>
                                <p class="card-text h5">{{ $presensi->jam_masuk }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-primary-custom">Pulang</h6>
                                <p class="card-text h5">{{ $presensi->jam_keluar }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-muted-custom mt-3">Terima kasih telah bekerja dengan baik hari ini!</p>
            @endif

        </div>
    </div>
</div>
@endsection