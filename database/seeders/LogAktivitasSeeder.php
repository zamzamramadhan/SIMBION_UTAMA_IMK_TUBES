<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LogAktivitas;

class LogAktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
    
        LogAktivitas::create([
            'user_id' => 1,
            'jenis' => 'Login',
            'detail' => 'Admin login pertama kali',
            'status' => 'info'
        ]);
    
    }
}
