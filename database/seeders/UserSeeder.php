<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;   // 🔥 WAJIB
use App\Models\Role;   // 🔥 WAJIB
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
            ]
        );

        // DOSEN
        $dosenRole = Role::where('name', 'dosen')->first();

        User::firstOrCreate(
            ['email' => 'dosen@mail.com'],
            [
                'name' => 'Dosen Dummy',
                'password' => Hash::make('password'),
                'role_id' => $dosenRole->id,
            ]
        );

        // KAPRODI
        $kaprodiRole = Role::where('name', 'kaprodi')->first();

        User::firstOrCreate(
            ['email' => 'kaprodi@mail.com'],
            [
                'name' => 'Kaprodi Dummy',
                'password' => Hash::make('password'),
                'role_id' => $kaprodiRole->id,
            ]
        );

        // MAHASISWA
        $mahasiswaRole = Role::where('name', 'mahasiswa')->first();

        User::firstOrCreate(
            ['email' => 'mahasiswa@mail.com'],
            [
                'name' => 'Mahasiswa Dummy',
                'password' => Hash::make('password'),
                'role_id' => $mahasiswaRole->id,
            ]
        );
    }
}
