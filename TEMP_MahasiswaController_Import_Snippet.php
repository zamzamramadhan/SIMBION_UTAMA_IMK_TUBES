<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class MahasiswaController extends Controller
{
    // ... existing index, create, store, edit, update, destroy ...

    public function import()
    {
        return view('admin.mahasiswa.import');
    }

    public function processImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);

        $file = $request->file('file');
        $role = Role::where('name', 'mahasiswa')->first();

        // Using SimpleExcel
        $rows = SimpleExcelReader::create($file->getPathname())->getRows();

        DB::transaction(function () use ($rows, $role) {
            foreach ($rows as $row) {
                // Expecting columns: NIM, Nama, Email, Angkatan
                // Note: SimpleExcel uses header row keys. Ensure Excel has headers!
                
                // Basic validation check
                if (!isset($row['NIM']) || !isset($row['Email'])) {
                    continue; // Skip invalid rows or throw error
                }

                // Check if User exists
                if (User::where('email', $row['Email'])->exists()) {
                    continue; // Skip duplicate email
                }
                
                if (Mahasiswa::where('nim', $row['NIM'])->exists()) {
                    continue; // Skip duplicate NIM
                }

                $user = User::create([
                    'name' => $row['Nama'] ?? $row['NIM'],
                    'email' => $row['Email'],
                    'password' => Hash::make($row['NIM']), // Default password = NIM
                    'role_id' => $role->id,
                ]);
                $user->role()->associate($role);
                $user->save();

                Mahasiswa::create([
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'nim' => $row['NIM'],
                    'angkatan' => $row['Angkatan'] ?? date('Y'),
                    'status' => 'aktif'
                ]);
            }
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diimport via Excel/CSV.');
    }
}
