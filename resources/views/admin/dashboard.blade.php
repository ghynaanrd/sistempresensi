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
        transition: all 0.3s ease;
    }
    
    .card-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .circle-stat {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        font-weight: 600;
    }
    
    .circle-stat-primary {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
    }
    
    .circle-stat-success {
        background: linear-gradient(135deg, #2d5a2d, #3a7a3a);
    }
    
    .circle-stat-info {
        background: linear-gradient(135deg, #1e4a5f, #2c6a82);
    }
    
    .circle-stat-warning {
        background: linear-gradient(135deg, #8a6d3b, #b8943c);
    }
    
    .circle-stat-danger {
        background: linear-gradient(135deg, #8a3b3b, #b83c3c);
    }
    
    .circle-stat-secondary {
        background: linear-gradient(135deg, #4a5568, #718096);
    }
    
    .text-primary-custom {
        color: var(--primary-dark) !important;
    }
    
    .bg-primary-custom {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium)) !important;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-2" style="font-size: 1.2rem; font-weight: 600; color: var(--primary-dark);">Statistik Kehadiran</h4>
                <p class="text-muted mb-0" style="font-size: 0.85rem;">Ringkasan kehadiran karyawan</p>
            </div>
            <!-- Total Karyawan Card - Versi Ringkas -->
            <div class="card bg-primary-custom text-white shadow-sm" style="width: 200px;">
                <div class="card-body text-center py-3">
                    <h6 class="mb-1">Total Karyawan</h6>
                    <h4 class="mb-1">{{ $totalKaryawan }}</h4>
                    <p class="mb-0 small opacity-75">Seluruh karyawan terdaftar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Grid -->
<div class="row">
    <!-- Kolom Kiri - Masuk -->
    <div class="col-md-6">
        <!-- Hari Ini -->
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-body">
                <h6 class="card-title text-primary-custom mb-3">Hari Ini</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1" style="color: var(--primary-dark);"><strong>Karyawan Masuk</strong></h6>
                        <p class="text-muted small mb-0">Total karyawan yang sudah presensi masuk</p>
                    </div>
                    <div class="text-center">
                        <div class="circle-stat circle-stat-primary">
                            <h4 class="mb-0">{{ $rekapharian }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulan Ini -->
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-body">
                <h6 class="card-title text-success mb-3">Bulan Ini</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1" style="color: var(--primary-dark);"><strong>Total Presensi Masuk</strong></h6>
                        <p class="text-muted small mb-0">Akumulasi presensi masuk bulan ini</p>
                    </div>
                    <div class="text-center">
                        <div class="circle-stat circle-stat-success">
                            <h4 class="mb-0">{{ $rekapbulanan }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tahun Ini -->
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-body">
                <h6 class="card-title text-info mb-3">Tahun Ini</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1" style="color: var(--primary-dark);"><strong>Total Presensi Masuk</strong></h6>
                        <p class="text-muted small mb-0">Akumulasi presensi masuk tahun ini</p>
                    </div>
                    <div class="text-center">
                        <div class="circle-stat circle-stat-info">
                            <h4 class="mb-0">{{ $rekaptahunan }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan - Pulang & Total Karyawan -->
    <div class="col-md-6">
        <!-- Karyawan Pulang Hari Ini -->
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-body">
                <h6 class="card-title text-warning mb-3">Hari Ini</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1" style="color: var(--primary-dark);"><strong>Karyawan Pulang</strong></h6>
                        <p class="text-muted small mb-0">Total karyawan yang sudah presensi pulang</p>
                    </div>
                    <div class="text-center">
                        <div class="circle-stat circle-stat-warning">
                            <h4 class="mb-0">1</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pulang Bulan Ini -->
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-body">
                <h6 class="card-title text-danger mb-3">Bulan Ini</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1" style="color: var(--primary-dark);"><strong>Total Presensi Pulang</strong></h6>
                        <p class="text-muted small mb-0">Akumulasi presensi pulang bulan ini</p>
                    </div>
                    <div class="text-center">
                        <div class="circle-stat circle-stat-danger">
                            <h4 class="mb-0">2</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pulang Tahun Ini -->
        <div class="card card-custom shadow-sm mb-4">
            <div class="card-body">
                <h6 class="card-title text-secondary mb-3">Tahun Ini</h6>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1" style="color: var(--primary-dark);"><strong>Total Presensi Pulang</strong></h6>
                        <p class="text-muted small mb-0">Akumulasi presensi pulang tahun ini</p>
                    </div>
                    <div class="text-center">
                        <div class="circle-stat circle-stat-secondary">
                            <h4 class="mb-0">2</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection