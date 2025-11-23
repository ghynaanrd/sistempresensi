<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JamKerja;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Pak Bos Admin',
            'email' => 'admin@absen.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'admin',
            'jabatan' => 'Administrator'
        ]);

        // 2. Buat Akun Karyawan Dumy
        User::create([
            'name' => 'Budi Karyawan',
            'email' => 'budi@absen.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
            'jabatan' => 'Staff IT'
        ]);

        // 3. Setting Jam Kerja Default
        JamKerja::create([
            'jam_masuk' => '08:00:00',
            'jam_pulang' => '17:00:00',
        ]);
    }
}