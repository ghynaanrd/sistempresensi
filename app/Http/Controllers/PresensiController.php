<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;
use App\Models\JamKerja;
use Carbon\Carbon; // Library untuk urus waktu/tanggal

class PresensiController extends Controller
{
    // 1. Halaman Dashboard Karyawan
    public function index()
    {
        $user_id = Auth::id();
        $hariIni = date('Y-m-d');

        // Cek apakah hari ini sudah absen?
        $presensi = Presensi::where('user_id', $user_id)
                            ->where('tanggal', $hariIni)
                            ->first();

        return view('karyawan.dashboard', compact('presensi'));
    }

    // 2. Proses Absen Masuk
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $hariIni = date('Y-m-d');
        $jamSekarang = date('H:i:s');

        // Cek dulu biar gak absen 2 kali
        $cek = Presensi::where('user_id', $user_id)->where('tanggal', $hariIni)->count();
        if($cek > 0){
            return redirect()->back()->with('error', 'Anda sudah absen masuk hari ini!');
        }

        // Ambil Setting Jam Kerja (untuk nentuin Telat/Tidak)
        $jamKerja = JamKerja::first(); // Asumsi cuma ada 1 settingan
        
        // Logika Penentuan Status
        if ($jamSekarang > $jamKerja->jam_masuk) {
            $status = 'Telat';
        } else {
            $status = 'Tepat Waktu';
        }

        // Simpan ke Database
        Presensi::create([
            'user_id' => $user_id,
            'tanggal' => $hariIni,
            'jam_masuk' => $jamSekarang,
            'jam_keluar' => null, // Pulangnya nanti
            'jam_kerja' => null,
            'status' => $status,  // <--- Ini kolom tambahan yang harus kita pastikan ada
        ]);

        return redirect()->back()->with('success', 'Berhasil Absen Masuk! Status: ' . $status);
    }

    // 3. Proses Absen Pulang
    public function pulang()
    {
        $user_id = Auth::id();
        $hariIni = date('Y-m-d');
        $jamSekarang = date('H:i:s');

        // Cari data presensi hari ini milik user ini
        $presensi = Presensi::where('user_id', $user_id)
                            ->where('tanggal', $hariIni)
                            ->first();

        // Validasi: Kalau belum absen masuk, gak bisa pulang
        if (!$presensi) {
            return redirect()->back()->with('error', 'Anda belum absen masuk hari ini!');
        }

        // Hitung Durasi Kerja (Opsional, tapi bagus buat data)
        $waktuMasuk = \Carbon\Carbon::parse($presensi->jam_masuk);
        $waktuKeluar = \Carbon\Carbon::parse($jamSekarang);
        $durasi = $waktuMasuk->diffInHours($waktuKeluar) . ' Jam';

        // Update data di database
        $presensi->update([
            'jam_keluar' => $jamSekarang,
            'jam_kerja' => $durasi
        ]);

        return redirect()->back()->with('success', 'Hati-hati di jalan! Anda berhasil absen pulang.');
    }

    // 4. Menampilkan Riwayat Absen (UPDATE DENGAN FILTER)
    public function riwayat(Request $request)
    {
        $user_id = Auth::id();
        
        // Query dasar: milik user yang login
        $query = Presensi::where('user_id', $user_id)->orderBy('tanggal', 'desc');

        // Tambahan Logika Filter Tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $riwayat = $query->get();

        return view('karyawan.riwayat', compact('riwayat'));
    }
}