<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - PT Absen Terus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PT Absen Terus</a>
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button class="btn btn-danger btn-sm" type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar vh-100 pt-3">
                <div class="position-sticky">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link text-dark fw-bold" href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('karyawan.dashboard') }}">
                                🏠 Dashboard
                            </a>
                        </li>

                        @if(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('karyawan.index') }}">
                                    👥 Data Karyawan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('admin.rekap') }}">
                                    📊 Rekap Semua Absen
                                </a>
                            </li>
                        @endif
                    </ul>
    @if(Auth::user()->role == 'karyawan')
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('karyawan.riwayat') }}">
                🕒 Riwayat Absenku
            </a>
        </li>
    @endif

</ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>