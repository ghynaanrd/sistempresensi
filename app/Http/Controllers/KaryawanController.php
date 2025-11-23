<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    // 1. Menampilkan Daftar Karyawan (SUDAH DIUPDATE DENGAN PENCARIAN)
    public function index(Request $request)
    {
        // Mulai query dari tabel User
        $query = User::query();

        // Logika Pencarian: Jika admin mengetik sesuatu di box search
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'LIKE', '%' . $request->search . '%');
        } else {
            // Jika tidak mencari, tampilkan user dengan role 'karyawan' saja (default)
            // ATAU bisa dihapus baris ini jika ingin menampilkan Admin juga di tabel
            $query->where('role', 'karyawan'); 
        }

        // Ambil datanya
        $karyawans = $query->get();

        return view('admin.karyawan.index', compact('karyawans'));
    }

    // 2. Menampilkan Form Tambah
    public function create()
    {
        return view('admin.karyawan.create');
    }
    
    // 3. Menyimpan Data Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'jabatan' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'karyawan', // Otomatis set jadi karyawan
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    // 4. Menghapus Karyawan
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // 2. HALAMAN EDIT
    public function edit($id)
    {
        $karyawan = User::find($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }
    // 3. PROSES UPDATE
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'jabatan' => 'required',
            'role' => 'required'
        ]);

        // Data yang mau diupdate
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'role' => $request->role, // <-- Ini proses simpan perubahan Hak Akses
        ];

        // Cek Password: Kalau diisi, kita hash dan simpan. Kalau kosong, abaikan.
        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui!');
    }
}