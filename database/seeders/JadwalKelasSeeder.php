<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JadwalKelas;
class JadwalKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        
        foreach (range(1, 5) as $i) {
            $day = $days[array_rand($days)];
            
            JadwalKelas::create([
                'kelas_id' => rand(1, 5),
                'hari' => $day,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '09:00:00',
                'tanggal' => now()->addDays(rand(0, 7))->format('Y-m-d')
            ]);
        }
    }
}
