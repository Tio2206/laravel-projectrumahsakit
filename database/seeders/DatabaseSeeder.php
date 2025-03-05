<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '12345',
        ]);

        // Seeder for ruangans
        $ruangans = [
            ['kodeRuangan' => 'R001', 'namaRuangan' => 'Ruang Operasi', 'dayaTampung' => 10, 'lokasi' => 'Gedung A'],
            ['kodeRuangan' => 'R002', 'namaRuangan' => 'Ruang ICU', 'dayaTampung' => 5, 'lokasi' => 'Gedung B'],
            ['kodeRuangan' => 'R003', 'namaRuangan' => 'Ruang Konsultasi', 'dayaTampung' => 3, 'lokasi' => 'Gedung C'],
        ];

        DB::table('ruangans')->insert($ruangans);

        // Get lokasi from ruangans
        $lokasiRuangans = array_column($ruangans, 'lokasi');

        // Seeder for dokters
        $dokters = [
            ['idDokter' => 'D001', 'namaDokter' => 'Dr. Siti', 'tanggalLahir' => '1980-05-12', 'spesialisasi' => 'Poli Bedah', 'lokasiPraktik' => $lokasiRuangans[0], 'jamPraktik' => '08:00'],
            ['idDokter' => 'D002', 'namaDokter' => 'Dr. Budi', 'tanggalLahir' => '1975-09-23', 'spesialisasi' => 'Poli Jantung', 'lokasiPraktik' => $lokasiRuangans[1], 'jamPraktik' => '10:00'],
            ['idDokter' => 'D003', 'namaDokter' => 'Dr. Andi', 'tanggalLahir' => '1982-12-02', 'spesialisasi' => 'Poli Umum', 'lokasiPraktik' => $lokasiRuangans[2], 'jamPraktik' => '09:00'],
        ];

        DB::table('dokters')->insert($dokters);
    }
}
