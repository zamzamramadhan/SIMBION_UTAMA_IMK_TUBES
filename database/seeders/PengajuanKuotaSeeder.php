<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengajuanKuota;
use App\Models\Dosen;

class PengajuanKuotaSeeder extends Seeder
{
    public function run(): void
    {
        $dosen = Dosen::first();

        if (! $dosen) return;

        PengajuanKuota::create([
            'dosen_id' => $dosen->id,
            'jumlah' => 5,
            'alasan' => 'Banyak mahasiswa yang berminat.',
            'status' => 'pending',
        ]);
    }
}
