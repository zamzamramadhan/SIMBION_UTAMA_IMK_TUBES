<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanPembimbingController extends Controller
{
    public function create()
    {
        return view('mahasiswa.pengajuan');
    }

    public function store(Request $request)
    {
        PengajuanPembimbing::create([
            'mahasiswa_id' => Auth::id(),
            'dosen_id' => $request->dosen_id,
            'status' => 'pending'
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengajukan dosen pembimbing'
        ]);

        return redirect()->back()->with('success','Pengajuan berhasil');
    }
}
