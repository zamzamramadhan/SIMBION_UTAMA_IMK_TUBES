<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        // Dosen 1 (from UserSeeder)
        $userDosen1 = \App\Models\User::where('email', 'dosen@mail.com')->first();
        if ($userDosen1) {
            DB::table('dosens')->updateOrInsert(
                ['user_id' => $userDosen1->id],
                [
                    'nama' => $userDosen1->name,
                    'nidn' => '12345678',
                    'kuota' => 10,
                    'status' => 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Additional Dosen
        $dosenRole = \App\Models\Role::where('name', 'dosen')->first();
        $userDosen2 = \App\Models\User::firstOrCreate(
            ['email' => 'siti@mail.com'],
            [
                'name' => 'Dr. Siti Aminah',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role_id' => $dosenRole->id
            ]
        );
        
        DB::table('dosens')->updateOrInsert(
            ['user_id' => $userDosen2->id],
            [
                'nama' => $userDosen2->name,
                'nidn' => '87654321',
                'kuota' => 10,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
