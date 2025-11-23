@extends('layouts.admin')

@section('content')
<h3>Halo, {{ Auth::user()->name }}! 👋</h3>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow h-100">
            <div class="card-body">
                <h6>Total Karyawan</h6>
                <h2>{{ $totalKaryawan }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white shadow h-100">
            <div class="card-body">
                <h6>Hadir Hari Ini</h6>
                <h2>{{ $rekapharian }}</h2>
                <small>{{ date('d F Y') }}</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white shadow h-100">
            <div class="card-body">
                <h6>Hadir Bulan Ini</h6>
                <h2>{{ $rekapbulanan }}</h2>
                <small>Bulan {{ date('F') }}</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white shadow h-100">
            <div class="card-body">
                <h6>Hadir Tahun Ini</h6>
                <h2>{{ $rekaptahunan }}</h2>
                <small>Tahun {{ date('Y') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection