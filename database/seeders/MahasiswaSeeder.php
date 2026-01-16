<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = \App\Models\User::where('email', 'mahasiswa@mail.com')->first();
        
        if ($user) {
            DB::table('mahasiswas')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'nama' => $user->name,
                    'nim' => '20240001',
                    'angkatan' => '2024',
                    'status' => 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

    }
}
