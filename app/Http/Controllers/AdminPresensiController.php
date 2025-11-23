<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;

class AdminPresensiController extends Controller
{
    // 1. Tampilkan Rekap (Bisa Filter Tanggal)
    public function index(Request $request)
    {
        // Mulai query, join ke tabel user, urutkan tanggal terbaru
        $query = Presensi::with('user')->orderBy('tanggal', 'desc');

        // Jika ada input tanggal dari Filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $presensis = $query->get();
        return view('admin.rekap', compact('presensis'));
    }

    // 2. Tampilkan Halaman Edit Absen
    public function edit($id)
    {
        $presensi = Presensi::with('user')->find($id);
        return view('admin.presensi.edit', compact('presensi'));
    }

    // 3. Simpan Perubahan (Update)
    public function update(Request $request, $id)
    {
        $presensi = Presensi::find($id);
        
        // Update data
        $presensi->update([
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.rekap')->with('success', 'Data presensi berhasil diubah!');
    }

    // 4. Hapus Data Absen
    public function destroy($id)
    {
        $presensi = Presensi::find($id);
        $presensi->delete();
        return redirect()->back()->with('success', 'Data presensi berhasil dihapus.');
    }
}