<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Role;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class MahasiswaController extends Controller
{
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
        
        // Check extension manually for safe usage with SimpleExcel if needed, but Reader handles it.
        $reader = SimpleExcelReader::create($file->getPathname());
        
        DB::transaction(function () use ($reader) {
             $role = Role::where('name', 'mahasiswa')->first();
             
             $reader->getRows()->each(function(array $row) use ($role) {
                // Expecting columns: NIM, Nama, Email, Angkatan
                // Case insensitive check could be better, but assuming strictly: NIM, Nama, Email, Angkatan
                
                $nim = $row['NIM'] ?? $row['nim'] ?? null;
                $email = $row['Email'] ?? $row['email'] ?? null;
                $nama = $row['Nama'] ?? $row['nama'] ?? 'Mahasiswa';
                $angkatan = $row['Angkatan'] ?? $row['angkatan'] ?? date('Y');

                if (!$nim || !$email) return;

                if (User::where('email', $email)->exists()) return;
                if (Mahasiswa::where('nim', $nim)->exists()) return;

                $user = User::create([
                    'name' => $nama,
                    'email' => $email,
                    'password' => Hash::make($nim), // Default password = NIM
                    'role_id' => $role->id,
                ]);
                $user->role()->associate($role);
                $user->save();

                Mahasiswa::create([
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'nim' => $nim,
                    'angkatan' => $angkatan,
                    'status' => 'aktif'
                ]);
             });
        });
         
        // Log Activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'jenis' => 'Import',
            'detail' => 'Import data mahasiswa dari file Excel',
            'status' => 'success'
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diimport.');
    }

    public function index(Request $request)
    {
        $query = Mahasiswa::with('user');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        $mahasiswas = $query->paginate(10);
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'nim' => 'required|string|unique:mahasiswas',
            'angkatan' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($request) {
            $role = Role::where('name', 'mahasiswa')->first();

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $role->id,
            ]);
            $user->role()->associate($role);
            $user->save();

            Mahasiswa::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'nim' => $request->nim,
                'angkatan' => $request->angkatan,
                'status' => 'aktif'
            ]);
            
            // Log Activity
            LogAktivitas::create([
                'user_id' => auth()->id(),
                'jenis' => 'Create',
                'detail' => 'Menambahkan mahasiswa baru: ' . $request->nama,
                'status' => 'success'
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim,'.$mahasiswa->id,
            'angkatan' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'password' => 'nullable|string|min:8|confirmed', // Optional password reset
        ]);

        DB::transaction(function () use ($request, $mahasiswa) {
            // Update Profile
            $mahasiswa->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'angkatan' => $request->angkatan,
                'status' => $request->status,
            ]);

            // Update User
            $userUpdate = ['name' => $request->nama];
            if ($request->filled('password')) {
                $userUpdate['password'] = Hash::make($request->password);
            }
            $mahasiswa->user->update($userUpdate);
            
            // Log Activity
            LogAktivitas::create([
                'user_id' => auth()->id(),
                'jenis' => 'Update',
                'detail' => 'Memperbarui data mahasiswa: ' . $request->nama,
                'status' => 'info'
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswaName = $mahasiswa->nama;
        $mahasiswa->user->delete(); // Cascades
        
        // Log Activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'jenis' => 'Delete',
            'detail' => 'Menghapus mahasiswa: ' . $mahasiswaName,
            'status' => 'warning'
        ]);
        
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
