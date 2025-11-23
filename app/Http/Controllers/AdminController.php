<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Presensi;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil data ringkas untuk ditampilkan di dashboard
        $totalKaryawan = User::where('role', 'karyawan')->count();

        // 2. Siapkan Tanggal
        $hariIni = date('Y-m-d');
        $bulanIni = date('m');
        $tahunIni = date('Y');

        // 3. Hitung Presensi (Harian, Bulanan, Tahunan)
        $rekapharian = Presensi::whereDate('tanggal', $hariIni)->count();
        $rekapbulanan = Presensi::whereMonth('tanggal', $bulanIni)
                                ->whereYear('tanggal', $tahunIni)
                                ->count();
        $rekaptahunan = Presensi::whereYear('tanggal', $tahunIni)->count();

        // Hitung yang hadir hari ini (untuk fitur dashboard nanti)
        //$hariIni = date('Y-m-d');
        //$hadirHariIni = Presensi::where('tanggal', $hariIni)->count();

        return view('admin.dashboard', compact(
        'totalKaryawan', 
        'rekapharian', 
        'rekapbulanan', 
        'rekaptahunan'
        ));
    }

    // 2. Halaman Rekapitulasi Absensi (Semua Karyawan)
    public function rekap()
    {
        // Mengambil semua data presensi + data usernya (Join)
        // Diurutkan dari tanggal terbaru
        $presensis = Presensi::with('user')->orderBy('tanggal', 'desc')->get();
        
        return view('admin.rekap', compact('presensis'));
    }
}