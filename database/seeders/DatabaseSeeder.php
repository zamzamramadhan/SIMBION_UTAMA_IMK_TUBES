<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pengajuankuota;
use App\Models\PengajuanPembimbing;
use App\Models\LogAktivitas;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        RoleSeeder::class,
        UserSeeder::class,
        DosenSeeder::class,
        MahasiswaSeeder::class,
        PengajuanKuotaSeeder::class,
        PengajuanPembimbingSeeder::class,
        LogAktivitasSeeder::class,
    ]);

        // User::factory(1)->create();
    
    }
}
