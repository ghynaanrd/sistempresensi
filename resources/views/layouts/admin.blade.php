<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - PT Absen Terus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Variabel warna baru - Biru Dongker & Cream */
        :root {
            --primary-dark: #1e3a5f;  /* Biru dongker */
            --primary-medium: #2c5282; /* Biru sedang */
            --primary-light: #4a7bbe;  /* Biru terang */
            --cream-bg: #f8f4e9;       /* Cream untuk background */
            --cream-card: #fffbf0;     /* Cream lebih terang untuk kartu */
            --accent-gold: #d4af37;    /* Emas untuk aksen */
        }
        
        /* Styling untuk menu horizontal di tengah atas */
        .menu-container {
            background: var(--cream-card);
            border-radius: 50px;
            padding: 0.4rem;
            margin: 0.5rem auto 1rem auto;
            max-width: 600px;
            width: 90%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            height: 45px;
            border: 1px solid rgba(30, 58, 95, 0.1);
        }
        .menu-container .nav-link {
            color: #555;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
            font-size: 0.85rem;
            background: transparent;
            border: 2px solid transparent;
            flex: 1;
            text-align: center;
            margin: 0 0.1rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .menu-container .nav-link:hover {
            color: var(--primary-medium);
            background: rgba(44, 82, 130, 0.1);
        }
        .menu-container .nav-link.active {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30, 58, 95, 0.3);
            border: 2px solid var(--primary-medium);
        }
        
        /* Styling untuk navbar atas */
        .dashboard-admin-title {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 0.1rem;
            color: white;
        }
        .welcome-text {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 0;
        }
        .company-name {
            font-size: 0.85rem;
            color: white;
            font-weight: 500;
        }
        .navbar-custom {
            padding-top: 0.4rem;
            padding-bottom: 0.4rem;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium)) !important;
        }
        
        /* Styling untuk konten utama */
        .main-content {
            min-height: calc(100vh - 150px);
            background-color: var(--cream-bg);
            border-radius: 10px;
            padding: 20px;
            margin-top: 10px;
            border: 1px solid rgba(30, 58, 95, 0.1);
        }
        
        /* Efek hover untuk kartu */
        .card-hover {
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: var(--cream-card);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        /* Warna khusus untuk kartu statistik */
        .card-primary-custom {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
            color: white;
            border: none;
        }
        .card-success-custom {
            background: linear-gradient(135deg, #2d5a2d, #3a7a3a);
            color: white;
            border: none;
        }
        .card-warning-custom {
            background: linear-gradient(135deg, #8a6d3b, #b8943c);
            color: white;
            border: none;
        }
        
        /* Styling untuk tombol */
        .btn-primary-custom {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }
        .btn-primary-custom:hover {
            background-color: var(--primary-medium);
            border-color: var(--primary-medium);
        }
        
        .btn-outline-primary-custom {
            border-color: var(--primary-dark);
            color: var(--primary-dark);
            background-color: transparent;
        }
        .btn-outline-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }
        
        /* Styling untuk progress bar */
        .progress-bar-custom {
            background-color: var(--primary-medium);
        }
        
        /* Styling untuk tabel */
        .table-custom thead {
            background-color: var(--primary-dark);
            color: white;
        }
        
        /* Styling untuk card header konsisten */
        .card-header-custom {
            background-color: var(--primary-dark);
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        /* Styling untuk badge */
        .badge-custom {
            background-color: var(--primary-light);
            color: white;
        }
        
        /* Responsif untuk menu */
        @media (max-width: 768px) {
            .menu-container {
                flex-wrap: wrap;
                height: auto;
                border-radius: 20px;
                padding: 0.5rem;
            }
            .menu-container .nav-link {
                flex: 1 0 45%;
                margin: 0.2rem;
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
        }
        
        @media (max-width: 480px) {
            .menu-container .nav-link {
                flex: 1 0 100%;
            }
        }
        
        /* Background body */
        body {
            background-color: #f0f0f0;
        }
        
        /* Styling untuk text primary custom */
        .text-primary-custom {
            color: var(--primary-dark) !important;
        }
    </style>
</head>
<body>
    <!-- Navbar Atas -->
    <nav class="navbar navbar-dark sticky-top navbar-custom">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <div class="dashboard-admin-title">Dashboard Admin</div>
                <div class="welcome-text">Selamat datang, {{ Auth::user()->name }}</div>
            </div>
            <div class="d-flex align-items-center">
                <span class="company-name me-2">PT Absen Terus</span>
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Menu Container Horizontal di Tengah Atas -->
    <div class="container-fluid">
        <div class="menu-container">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') || request()->routeIs('karyawan.dashboard') ? 'active' : '' }}" 
               href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('karyawan.dashboard') }}">
                📊 Dashboard
            </a>

            @if(Auth::user()->role == 'admin')
                <a class="nav-link {{ request()->routeIs('karyawan.*') ? 'active' : '' }}" 
                   href="{{ route('karyawan.index') }}">
                    👥 Kelola Karyawan
                </a>
                <a class="nav-link {{ request()->routeIs('admin.rekap') ? 'active' : '' }}" 
                   href="{{ route('admin.rekap') }}">
                    📈 Rekap Kehadiran
                </a>
            @endif
            
            @if(Auth::user()->role == 'karyawan')
                <a class="nav-link {{ request()->routeIs('karyawan.riwayat') ? 'active' : '' }}" 
                   href="{{ route('karyawan.riwayat') }}">
                    🕒 Riwayat Absenku
                </a>
            @endif
        </div>
    </div>

    <!-- Area Konten Utama -->
    <div class="container-fluid">
        <main class="px-md-4 pt-3">
            <div class="main-content">
                <!-- Header Konten -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-primary-custom">
                        @if(request()->routeIs('admin.dashboard') || request()->routeIs('karyawan.dashboard'))
                            Dashboard Utama
                        @elseif(request()->routeIs('karyawan.*'))
                            Kelola Data Karyawan
                        @elseif(request()->routeIs('admin.rekap'))
                            Rekap Kehadiran
                        @elseif(request()->routeIs('karyawan.riwayat'))
                            Riwayat Absensi
                        @else
                            Halaman Admin
                        @endif
                    </h4>
                    <div class="text-muted">
                        <small>{{ now()->format('l, d F Y') }}</small>
                    </div>
                </div>
                
                <!-- Konten Dinamis -->
                @yield('content')
                
                <!-- Default content jika tidak ada yield content -->
                @hasSection('content')
                @else
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card card-primary-custom text-white card-hover">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">Total Karyawan</h5>
                                        <h2 class="mb-0">125</h2>
                                    </div>
                                    <div class="align-self-center">
                                        <span class="fs-1">👥</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card card-success-custom text-white card-hover">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">Hadir Hari Ini</h5>
                                        <h2 class="mb-0">98</h2>
                                    </div>
                                    <div class="align-self-center">
                                        <span class="fs-1">✅</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card card-warning-custom text-white card-hover">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title">Izin / Cuti</h5>
                                        <h2 class="mb-0">12</h2>
                                    </div>
                                    <div class="align-self-center">
                                        <span class="fs-1">📝</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="card card-hover">
                            <div class="card-header card-header-custom">
                                <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Budi Santoso</strong> melakukan check-in
                                        </div>
                                        <small class="text-muted">08:00</small>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Siti Rahayu</strong> mengajukan cuti
                                        </div>
                                        <small class="text-muted">08:15</small>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Ahmad Fauzi</strong> melakukan check-out
                                        </div>
                                        <small class="text-muted">17:05</small>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Dewi Lestari</strong> terlambat 15 menit
                                        </div>
                                        <small class="text-muted">08:16</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card card-hover">
                            <div class="card-header card-header-custom">
                                <h5 class="card-title mb-0">Statistik Bulan Ini</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Kehadiran</span>
                                        <span>85%</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar progress-bar-custom" style="width: 85%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Terlambat</span>
                                        <span>8%</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: 8%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Tidak Hadir</span>
                                        <span>7%</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-danger" style="width: 7%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-hover">
                            <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Daftar Karyawan</h5>
                                <button class="btn btn-primary-custom btn-sm">Lihat Semua</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-custom">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Divisi</th>
                                                <th>Status</th>
                                                <th>Jam Masuk</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Budi Santoso</td>
                                                <td>IT</td>
                                                <td><span class="badge bg-success">Hadir</span></td>
                                                <td>08:00</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary-custom">Detail</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Siti Rahayu</td>
                                                <td>HR</td>
                                                <td><span class="badge bg-warning">Cuti</span></td>
                                                <td>-</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary-custom">Detail</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ahmad Fauzi</td>
                                                <td>Marketing</td>
                                                <td><span class="badge bg-success">Hadir</span></td>
                                                <td>08:05</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary-custom">Detail</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>