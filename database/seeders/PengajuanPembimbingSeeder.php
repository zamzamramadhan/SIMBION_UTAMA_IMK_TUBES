<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PengajuanPembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengajuan_pembimbings')->insert([
        'mahasiswa_id' => 1,
        'dosen_id' => 1,
        'status' => 'disetujui'
    ]);

    }
}
