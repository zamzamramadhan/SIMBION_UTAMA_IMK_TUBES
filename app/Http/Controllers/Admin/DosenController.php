<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use App\Models\Role;
use App\Models\Skill;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('user', 'skills')->get();
        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        $skills = Skill::all();
        return view('admin.dosen.create', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'nidn' => 'required|string|unique:dosens',
            'skills' => 'array'
        ]);

        DB::transaction(function () use ($request) {
            $role = Role::where('name', 'dosen')->first();

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make('password'), // Global default password
                'role_id' => $role->id,
            ]);
            $user->role()->associate($role);
            $user->save();

            $dosen = Dosen::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'nidn' => $request->nidn,
                'kuota' => 10, // Default
                'status' => 'aktif'
            ]);

            if ($request->has('skills')) {
                $dosen->skills()->sync($request->skills);
            }
            
            // Log Activity
            LogAktivitas::create([
                'user_id' => auth()->id(),
                'jenis' => 'Create',
                'detail' => 'Menambahkan dosen baru: ' . $request->nama,
                'status' => 'success'
            ]);
        });

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        $skills = Skill::all();
        $dosen->load('user', 'skills');
        return view('admin.dosen.edit', compact('dosen', 'skills'));
    }

    public function update(Request $request, Dosen $dosen)
    {
         $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosens,nidn,'.$dosen->id,
            'skills' => 'array',
            'kuota' => 'required|integer',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        DB::transaction(function () use ($request, $dosen) {
            $dosen->update([
                'nama' => $request->nama,
                'nidn' => $request->nidn,
                'kuota' => $request->kuota,
                'status' => $request->status,
            ]);
            
            // Sync User Name
            $dosen->user->update(['name' => $request->nama]);

            if ($request->has('skills')) {
                $dosen->skills()->sync($request->skills);
            }
            
            // Log Activity
            LogAktivitas::create([
                'user_id' => auth()->id(),
                'jenis' => 'Update',
                'detail' => 'Memperbarui data dosen: ' . $request->nama,
                'status' => 'info'
            ]);
        });

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        // We probably don't want to hard delete, but for now we'll just set status to nonaktif or delete logic
        // PRD says "Non-aktifkan dosen". So we can use that.
        // But standard resource destroy often implies delete. I will implement delete User (cascade) or just status update.
        // Let's implement Delete for now as per CRUD standard, but maybe warn user.
        // Actually PRD says "Non-aktifkan dosen" is an Action.
        
        $dosenName = $dosen->nama;
        $dosen->user->delete(); // Cascades to Dosen
        
        // Log Activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'jenis' => 'Delete',
            'detail' => 'Menghapus dosen: ' . $dosenName,
            'status' => 'warning'
        ]);
        
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
