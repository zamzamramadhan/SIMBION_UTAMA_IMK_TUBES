<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Mahasiswa; // Added
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; // Added

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'nim' => 'required|string|unique:mahasiswas',
            'angkatan' => 'required|string',
        ]);

        // ambil role
        $role = Role::where('name', 'mahasiswa')->firstOrFail();

        DB::transaction(function () use ($request, $role) {
            // buat user TANPA role_id
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $role->id,
            ]);

            // set role lewat relasi (INI KUNCI-NYA)
            $user->role()->associate($role);
            $user->save();

            // Create Mahasiswa Profile
            Mahasiswa::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'nim' => $request->nim,
                'angkatan' => $request->angkatan,
                'status' => 'aktif',
            ]);

            Auth::login($user);
        });

        return redirect('/dashboard');
    }
}
